<?php

namespace App\Services;

class StudentFuzzyEvaluator2
{
    // Define weights for each input (must sum to 1.0)
    private $weights = [
        'attitude' => 0.2,    // 20% weight - lower importance
        'knowledge' => 0.4,   // 40% weight - higher importance
        'skill' => 0.4        // 40% weight - higher importance
    ];

    public function evaluate($attitude, $knowledgeScore, $skillScore, $customWeights = null)
    {
        // Allow custom weights if provided
        if ($customWeights) {
            $this->validateAndSetWeights($customWeights);
        }

        // Get membership degrees for each input
        $attitudeMembership = $this->getAttitudeMembership($attitude);
        $knowledgeMembership = $this->getKnowledgeSkillMembership($knowledgeScore);
        $skillMembership = $this->getKnowledgeSkillMembership($skillScore);

        // Apply weighted fuzzy rules and calculate numeric score
        $numericScore = $this->calculateWeightedNumericScore(
            $attitudeMembership, 
            $knowledgeMembership, 
            $skillMembership
        );

        // Map to performance category
        $performance = $this->mapToPerformance($numericScore);

        return [
            'numeric_score' => round($numericScore, 2),
            'performance' => $performance,
            'weights_used' => $this->weights,
            'details' => [
                'attitude_membership' => $attitudeMembership,
                'knowledge_membership' => $knowledgeMembership,
                'skill_membership' => $skillMembership,
                'weighted_contributions' => $this->getWeightedContributions($attitude, $knowledgeScore, $skillScore)
            ]
        ];
    }

    private function validateAndSetWeights($customWeights)
    {
        $sum = array_sum($customWeights);
        if (abs($sum - 1.0) > 0.001) {
            throw new \InvalidArgumentException("Weights must sum to 1.0. Current sum: {$sum}");
        }
        
        $this->weights = array_merge($this->weights, $customWeights);
    }

    private function getWeightedContributions($attitude, $knowledge, $skill)
    {
        return [
            'attitude_contribution' => ($attitude * $this->weights['attitude']),
            'knowledge_contribution' => ($knowledge * $this->weights['knowledge']),
            'skill_contribution' => ($skill * $this->weights['skill']),
            'weighted_average' => ($attitude * $this->weights['attitude']) + 
                                 ($knowledge * $this->weights['knowledge']) + 
                                 ($skill * $this->weights['skill'])
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

    private function calculateWeightedNumericScore($attitudeMembership, $knowledgeMembership, $skillMembership)
    {
        $rules = [];
        $totalWeight = 0;
        $weightedSum = 0;

        // Rule 1: Excellent (Sangat Baik = 90)
        // Weighted AND operation for fuzzy rules
        $excellentStrength = $this->weightedFuzzyAND([
            $attitudeMembership['good'] => $this->weights['attitude'],
            $knowledgeMembership['high'] => $this->weights['knowledge'],
            $skillMembership['high'] => $this->weights['skill']
        ]);
        if ($excellentStrength > 0) {
            $rules[] = ['strength' => $excellentStrength, 'output' => 90];
        }

        // Rule 2: Good scenarios (Baik = 75)
        $goodStrength1 = $this->weightedFuzzyAND([
            $attitudeMembership['fair'] => $this->weights['attitude'],
            $knowledgeMembership['medium'] => $this->weights['knowledge'],
            $skillMembership['medium'] => $this->weights['skill']
        ]);
        
        $goodStrength2 = $this->weightedFuzzyAND([
            $attitudeMembership['good'] => $this->weights['attitude'],
            $knowledgeMembership['medium'] => $this->weights['knowledge'],
            max($skillMembership['medium'], $skillMembership['high']) => $this->weights['skill']
        ]);
        
        $goodStrength3 = $this->weightedFuzzyAND([
            $attitudeMembership['fair'] => $this->weights['attitude'],
            $knowledgeMembership['high'] => $this->weights['knowledge'],
            $skillMembership['high'] => $this->weights['skill']
        ]);
        
        $goodStrength = max($goodStrength1, $goodStrength2, $goodStrength3);
        if ($goodStrength > 0) {
            $rules[] = ['strength' => $goodStrength, 'output' => 75];
        }

        // Rule 3: Average (Cukup Baik = 60)
        $averageStrength1 = $this->weightedFuzzyAND([
            $attitudeMembership['good'] => $this->weights['attitude'],
            $knowledgeMembership['medium'] => $this->weights['knowledge'],
            max($skillMembership['low'], $skillMembership['medium']) => $this->weights['skill']
        ]);
        
        $averageStrength2 = $this->weightedFuzzyAND([
            $attitudeMembership['fair'] => $this->weights['attitude'],
            max($knowledgeMembership['medium'], $knowledgeMembership['high']) => $this->weights['knowledge'],
            $skillMembership['medium'] => $this->weights['skill']
        ]);
        
        $averageStrength = max($averageStrength1, $averageStrength2);
        if ($averageStrength > 0) {
            $rules[] = ['strength' => $averageStrength, 'output' => 60];
        }

        // Rule 4: Poor (Kurang Baik = 40)
        // For poor performance, we use weighted OR (any component being poor affects the result)
        $poorStrength = $this->weightedFuzzyOR([
            $attitudeMembership['poor'] => $this->weights['attitude'],
            $knowledgeMembership['low'] => $this->weights['knowledge'],
            $skillMembership['low'] => $this->weights['skill']
        ]);
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

    /**
     * Weighted fuzzy AND operation
     * Knowledge and Skill have higher impact on the result
     */
    private function weightedFuzzyAND($membershipWeights)
    {
        $weightedSum = 0;
        $totalWeight = 0;
        
        foreach ($membershipWeights as $membership => $weight) {
            $weightedSum += $membership * $weight;
            $totalWeight += $weight;
        }
        
        // Normalize and apply weighted minimum
        $weightedAverage = $totalWeight > 0 ? $weightedSum / $totalWeight : 0;
        
        // Apply a minimum threshold based on the most important factors
        $minMembership = min(array_keys($membershipWeights));
        
        // Return the weighted result that considers both average and minimum
        return min($weightedAverage, $minMembership + (1 - $minMembership) * 0.3);
    }

    /**
     * Weighted fuzzy OR operation
     * Any poor performance affects the result, but knowledge/skill have more impact
     */
    private function weightedFuzzyOR($membershipWeights)
    {
        $weightedSum = 0;
        $totalWeight = 0;
        
        foreach ($membershipWeights as $membership => $weight) {
            $contribution = $membership * $weight;
            $weightedSum += $contribution;
            $totalWeight += $weight;
        }
        
        return $totalWeight > 0 ? $weightedSum / $totalWeight : 0;
    }

    private function mapToPerformance($numericScore)
    {
        if ($numericScore >= 80.5) {
            return '(BS) Baik Sekali';
        } elseif ($numericScore >= 65.5) {
            return '(B) Baik';
        } elseif ($numericScore >= 50.5) {
            return '(C) Cukup';
        } else {
            return '(PB) Perlu Bimbingan';
        }
    }

    // Method to update weights dynamically
    public function setWeights($attitude, $knowledge, $skill)
    {
        $total = $attitude + $knowledge + $skill;
        if ($total == 0) {
            throw new \InvalidArgumentException("Total weight cannot be zero");
        }
        
        $this->weights = [
            'attitude' => $attitude / $total,
            'knowledge' => $knowledge / $total,
            'skill' => $skill / $total
        ];
        
        return $this;
    }

    // Get current weights
    public function getWeights()
    {
        return $this->weights;
    }

    // Legacy method for backward compatibility
    public function evaluateLegacy($attitude, $knowledgeScore, $skillScore)
    {
        $result = $this->evaluate($attitude, $knowledgeScore, $skillScore);
        return $result['performance'];
    }
}

// Enhanced testing class
class FuzzyEvaluatorTester
{
    public static function test()
    {
        $evaluator = new StudentFuzzyEvaluator2();
        
        echo "=== Testing Default Weights (Attitude: 20%, Knowledge: 40%, Skill: 40%) ===\n\n";
        
        $testCases = [
            [80, 85, 90, "High attitude, high knowledge, high skill"],
            [40, 85, 90, "Low attitude, high knowledge, high skill - should still be good due to weights"],
            [90, 40, 40, "High attitude, low knowledge, low skill - should be poor due to weights"],
            [65, 70, 75, "Medium-high across all areas"],
            [70, 60, 65, "Good attitude, medium knowledge/skill"],
            [30, 45, 35, "Poor across all areas"],
            [50, 50, 50, "Boundary case - all medium"],
            [20, 80, 85, "Very poor attitude, excellent knowledge/skill"],
        ];

        foreach ($testCases as $i => $case) {
            [$attitude, $knowledge, $skill, $description] = $case;
            $result = $evaluator->evaluate($attitude, $knowledge, $skill);
            
            echo "Test Case " . ($i + 1) . ": {$description}\n";
            echo "  Input: Attitude={$attitude}, Knowledge={$knowledge}, Skill={$skill}\n";
            echo "  Weighted Contributions: A={$result['details']['weighted_contributions']['attitude_contribution']}, ";
            echo "K={$result['details']['weighted_contributions']['knowledge_contribution']}, ";
            echo "S={$result['details']['weighted_contributions']['skill_contribution']}\n";
            echo "  Numeric Score: {$result['numeric_score']}\n";
            echo "  Performance: {$result['performance']}\n";
            echo "  ---\n";
        }
        
        // Test with custom weights
        echo "\n=== Testing Custom Weights (Attitude: 10%, Knowledge: 50%, Skill: 40%) ===\n\n";
        
        $result = $evaluator->evaluate(30, 80, 85, [
            'attitude' => 0.1,
            'knowledge' => 0.5,
            'skill' => 0.4
        ]);
        
        echo "Custom Weight Test: Poor attitude (30), Excellent knowledge (80), Excellent skill (85)\n";
        echo "  Weights Used: Attitude={$result['weights_used']['attitude']}, Knowledge={$result['weights_used']['knowledge']}, Skill={$result['weights_used']['skill']}\n";
        echo "  Numeric Score: {$result['numeric_score']}\n";
        echo "  Performance: {$result['performance']}\n";
    }
    
    public static function compareWeightSystems()
    {
        $evaluator = new StudentFuzzyEvaluator2();
        
        echo "\n=== Comparing Different Weight Systems ===\n\n";
        
        $testCase = [30, 85, 80]; // Poor attitude, excellent knowledge/skill
        
        $weightSystems = [
            ['attitude' => 0.33, 'knowledge' => 0.33, 'skill' => 0.34], // Equal weights
            ['attitude' => 0.20, 'knowledge' => 0.40, 'skill' => 0.40], // Default (attitude lower)
            ['attitude' => 0.10, 'knowledge' => 0.50, 'skill' => 0.40], // Attitude much lower
            ['attitude' => 0.50, 'knowledge' => 0.25, 'skill' => 0.25], // Attitude higher
        ];
        
        foreach ($weightSystems as $i => $weights) {
            $result = $evaluator->evaluate($testCase[0], $testCase[1], $testCase[2], $weights);
            
            echo "Weight System " . ($i + 1) . ":\n";
            echo "  Weights - A: {$weights['attitude']}, K: {$weights['knowledge']}, S: {$weights['skill']}\n";
            echo "  Input: Attitude={$testCase[0]}, Knowledge={$testCase[1]}, Skill={$testCase[2]}\n";
            echo "  Result: {$result['numeric_score']} - {$result['performance']}\n";
            echo "  ---\n";
        }
    }
}