<x-filament-panels::page>
<div>
    <!-- Sikap Section -->
    <h2>A. Sikap</h2>
    <div>
        <!-- Existing Sikap fields -->
    </div>
    
    <!-- Pengetahuan dan Keterampilan Section -->
    <h2>B. Pengetahuan dan Keterampilan</h2>
    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr>
                <th class="border border-gray-300 p-2">No</th>
                <th class="border border-gray-300 p-2">Mata Pelajaran</th>
                <th colspan="2" class="border border-gray-300 p-2">Pengetahuan</th>
                <th colspan="2" class="border border-gray-300 p-2">Keterampilan</th>
            </tr>
            <tr>
                <th class="border border-gray-300 p-2"></th>
                <th class="border border-gray-300 p-2"></th>
                <th class="border border-gray-300 p-2">Angka</th>
                <th class="border border-gray-300 p-2">Huruf</th>
                <th class="border border-gray-300 p-2">Angka</th>
                <th class="border border-gray-300 p-2">Huruf</th>
            </tr>
        </thead>
        <tbody>
            <!-- Kelompok A (Wajib) -->
            <tr>
                <td colspan="6" class="border border-gray-300 p-2 font-bold">Kelompok A (Wajib)</td>
            </tr>
            @foreach ($kelompokA as $index => $subject)
            <tr>
                <td class="border border-gray-300 p-2">{{ $index + 1 }}</td>
                <td class="border border-gray-300 p-2">{{ $subject['name'] }}</td>
                <td class="border border-gray-300 p-2">{{ $subject['knowledge_score'] }}</td>
                <td class="border border-gray-300 p-2">{{ $subject['knowledge_grade'] }}</td>
                <td class="border border-gray-300 p-2">{{ $subject['skill_score'] }}</td>
                <td class="border border-gray-300 p-2">{{ $subject['skill_grade'] }}</td>
            </tr>
            @endforeach
            
            <!-- Kelompok B (Wajib) -->
            <tr>
                <td colspan="6" class="border border-gray-300 p-2 font-bold">Kelompok B (Wajib)</td>
            </tr>
            @foreach ($kelompokB as $index => $subject)
            <tr>
                <td class="border border-gray-300 p-2">{{ $index + 1 }}</td>
                <td class="border border-gray-300 p-2">{{ $subject['name'] }}</td>
                <td class="border border-gray-300 p-2">{{ $subject['knowledge_score'] }}</td>
                <td class="border border-gray-300 p-2">{{ $subject['knowledge_grade'] }}</td>
                <td class="border border-gray-300 p-2">{{ $subject['skill_score'] }}</td>
                <td class="border border-gray-300 p-2">{{ $subject['skill_grade'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

</x-filament-panels::page>
