<x-filament-panels::page>
  <div class="p-4">
        <table class="w-full border border-gray-300">
            <thead>
                <tr>
                    <th class="border p-2">Student</th>
                    @foreach ($dates as $date)
                        <th class="border p-2">{{ $date->format('Y-m-d') }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                    <tr>
                        <td class="border p-2">{{ $student->name }}</td>
                        @foreach ($dates as $date)
                            <td class="border p-2">
                                @if ($attendanceData[$student->id]->contains('date', $date->format('Y-m-d')))
                                    <input type="checkbox" checked disabled />
                                @else
                                    <input type="checkbox" disabled />
                                @endif
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-filament-panels::page>
