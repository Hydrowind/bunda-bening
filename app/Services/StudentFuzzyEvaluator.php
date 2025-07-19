<?php

// namespace App\Services;

// class StudentFuzzyEvaluator
// {
//     public function evaluate($attitude, $knowledgeScore, $skillScore)
//     {
//         // Fuzzify inputs
//         $attitudeLevel = $this->fuzzifyAttitude($attitude);
//         $knowledgeLevel = $this->fuzzifyKnowledgeSkill($knowledgeScore);
//         $skillLevel = $this->fuzzifyKnowledgeSkill($skillScore);

//         // Apply fuzzy rules
//         $performance = $this->applyRules($attitudeLevel, $knowledgeLevel, $skillLevel);

//         return $performance;
//     }

//     private function fuzzifyAttitude($value)
//     {
//         if ($value >= 0 && $value <= 40) {
//             return 'poor';
//         } elseif ($value > 40 && $value <= 70) {
//             return 'fair';
//         } else {
//             return 'good';
//         }
//     }

//     private function fuzzifyKnowledgeSkill($value)
//     {
//         if ($value >= 0 && $value <= 40) {
//             return 'low';
//         } elseif ($value > 40 && $value <= 70) {
//             return 'medium';
//         } else {
//             return 'high';
//         }
//     }

//     private function applyRules($attitude, $knowledge, $skill)
//     {
//         // Excellent
//         if ($attitude === 'good' && $knowledge === 'high' && $skill === 'high') {
//             return 'Sangat Baik';
//         }

//         // Good
//         if (($attitude === 'fair' && $knowledge === 'medium' && $skill === 'medium') ||
//             ($attitude === 'good' && $knowledge === 'medium') ||
//             ($knowledge === 'high' && $skill === 'high' && $attitude === 'fair')) {
//             return 'Baik';
//         }

//         // Average
//         if ($attitude === 'good' && $knowledge === 'medium') {
//             return 'Cukup Baik';
//         }

//         // Bad (catch all else)
//         if ($attitude === 'poor' || $knowledge === 'low' || $skill === 'low') {
//             return 'Kurang Baik';
//         }

//         // Default fallback
//         return 'Cukup Baik';
//     }
// }

namespace App\Services;

class StudentFuzzyEvaluator
{
    public function evaluate($attitude, $knowledgeScore, $skillScore)
    {
        // Get membership degrees for each input
        $attitudeMembership = $this->getAttitudeMembership($attitude);
        $knowledgeMembership = $this->getKnowledgeSkillMembership($knowledgeScore);
        $skillMembership = $this->getKnowledgeSkillMembership($skillScore);

        // Apply fuzzy rules and calculate numeric score
        $numericScore = $this->calculateNumericScore($attitudeMembership, $knowledgeMembership, $skillMembership);

        // Map to performance category
        $performance = $this->mapToPerformance($numericScore);

        return [
            'numeric_score' => round($numericScore, 2),
            'performance' => $performance,
            'details' => [
                'attitude_membership' => $attitudeMembership,
                'knowledge_membership' => $knowledgeMembership,
                'skill_membership' => $skillMembership
            ]
        ];
    }

    private function getAttitudeMembership($value)
    {
        $membership = [
            'poor' => 0,
            'fair' => 0,
            'good' => 0
        ];

        // Poor membership (0-50, peak at 25)
        if ($value <= 25) {
            $membership['poor'] = 1;
        } elseif ($value > 25 && $value <= 50) {
            $membership['poor'] = (50 - $value) / 25;
        }

        // Fair membership (25-75, peak at 50)
        if ($value >= 25 && $value <= 50) {
            $membership['fair'] = ($value - 25) / 25;
        } elseif ($value > 50 && $value <= 75) {
            $membership['fair'] = (75 - $value) / 25;
        }

        // Good membership (50-100, peak at 75+)
        if ($value >= 50 && $value <= 75) {
            $membership['good'] = ($value - 50) / 25;
        } elseif ($value > 75) {
            $membership['good'] = 1;
        }

        return $membership;
    }

    private function getKnowledgeSkillMembership($value)
    {
        $membership = [
            'low' => 0,
            'medium' => 0,
            'high' => 0
        ];

        // Low membership (0-50, peak at 25)
        if ($value <= 25) {
            $membership['low'] = 1;
        } elseif ($value > 25 && $value <= 50) {
            $membership['low'] = (50 - $value) / 25;
        }

        // Medium membership (25-75, peak at 50)
        if ($value >= 25 && $value <= 50) {
            $membership['medium'] = ($value - 25) / 25;
        } elseif ($value > 50 && $value <= 75) {
            $membership['medium'] = (75 - $value) / 25;
        }

        // High membership (50-100, peak at 75+)
        if ($value >= 50 && $value <= 75) {
            $membership['high'] = ($value - 50) / 25;
        } elseif ($value > 75) {
            $membership['high'] = 1;
        }

        return $membership;
    }

    private function calculateNumericScore($attitudeMembership, $knowledgeMembership, $skillMembership)
    {
        $rules = [];
        $totalWeight = 0;
        $weightedSum = 0;

        // Rule 1: Excellent (Sangat Baik = 90)
        $excellentStrength = min(
            $attitudeMembership['good'],
            $knowledgeMembership['high'],
            $skillMembership['high']
        );
        if ($excellentStrength > 0) {
            $rules[] = ['strength' => $excellentStrength, 'output' => 90];
        }

        // Rule 2: Good scenarios (Baik = 75)
        $goodStrength1 = min(
            $attitudeMembership['fair'],
            $knowledgeMembership['medium'],
            $skillMembership['medium']
        );
        $goodStrength2 = min(
            $attitudeMembership['good'],
            $knowledgeMembership['medium'],
            max($skillMembership['medium'], $skillMembership['high'])
        );
        $goodStrength3 = min(
            $attitudeMembership['fair'],
            $knowledgeMembership['high'],
            $skillMembership['high']
        );
        
        $goodStrength = max($goodStrength1, $goodStrength2, $goodStrength3);
        if ($goodStrength > 0) {
            $rules[] = ['strength' => $goodStrength, 'output' => 75];
        }

        // Rule 3: Average (Cukup Baik = 60)
        $averageStrength1 = min(
            $attitudeMembership['good'],
            $knowledgeMembership['medium'],
            max($skillMembership['low'], $skillMembership['medium'])
        );
        $averageStrength2 = min(
            $attitudeMembership['fair'],
            max($knowledgeMembership['medium'], $knowledgeMembership['high']),
            $skillMembership['medium']
        );
        
        $averageStrength = max($averageStrength1, $averageStrength2);
        if ($averageStrength > 0) {
            $rules[] = ['strength' => $averageStrength, 'output' => 60];
        }

        // Rule 4: Poor (Kurang Baik = 40)
        $poorStrength = max(
            $attitudeMembership['poor'],
            $knowledgeMembership['low'],
            $skillMembership['low']
        );
        if ($poorStrength > 0) {
            $rules[] = ['strength' => $poorStrength, 'output' => 40];
        }

        // Calculate weighted average (Centroid defuzzification)
        foreach ($rules as $rule) {
            $weightedSum += $rule['strength'] * $rule['output'];
            $totalWeight += $rule['strength'];
        }

        // Return weighted average or default if no rules fired
        return $totalWeight > 0 ? $weightedSum / $totalWeight : 60;
    }

    private function mapToPerformance($numericScore)
    {
        if ($numericScore >= 85) {
            return 'sangat baik';
        } elseif ($numericScore >= 70) {
            return 'baik';
        } elseif ($numericScore >= 55) {
            return 'cukup baik';
        } else {
            return 'kurang baik';
        }
    }

    // Legacy method for backward compatibility
    public function evaluateLegacy($attitude, $knowledgeScore, $skillScore)
    {
        $result = $this->evaluate($attitude, $knowledgeScore, $skillScore);
        return $result['performance'];
    }
}

// Example usage and testing
class FuzzyEvaluatorTester
{
    public static function test()
    {
        $evaluator = new StudentFuzzyEvaluator();
        
        $testCases = [
            [80, 85, 90],  // Should be "sangat baik"
            [65, 70, 75],  // Should be "baik"
            [70, 60, 65],  // Should be "cukup baik"
            [30, 45, 35],  // Should be "kurang baik"
            [50, 50, 50],  // Boundary case
        ];

        echo "Fuzzy Logic Evaluation Results:\n";
        echo "================================\n";
        
        foreach ($testCases as $i => $case) {
            [$attitude, $knowledge, $skill] = $case;
            $result = $evaluator->evaluate($attitude, $knowledge, $skill);
            
            echo "Test Case " . ($i + 1) . ":\n";
            echo "  Input: Attitude={$attitude}, Knowledge={$knowledge}, Skill={$skill}\n";
            echo "  Numeric Score: {$result['numeric_score']}\n";
            echo "  Performance: {$result['performance']}\n";
            echo "  ---\n";
        }
    }
}