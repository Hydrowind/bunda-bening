<x-filament-panels::page>
@php
  $kelompokA = [
    [
      'name' => 'Pendidikan Agama dan Budi Pekerti',
      'model' => 'religion',
    ],
    [
      'name' => 'Pendidikan Pancasila dan Kewarganegaraan',
      'model' => 'nation',
    ],
    [
      'name' => 'Bahasa Indonesia',
      'model' => 'indonesia',
    ],
    [
      'name' => 'Matematika',
      'model' => 'math',
    ],
    [
      'name' => 'Bahasa Inggris',
      'model' => 'english',
    ],
    [
      'name' => 'Ilmu Pengetahuan Alam',
      'model' => 'science',
    ],
    [
      'name' => 'Ilmu Pengetahuan Sosial',
      'model' => 'social',
    ],
  ];

  $kelompokB = [
    [
      'name' => 'Seni Budaya',
      'model' => 'art',
    ],
    [
      'name' => 'Pendidikan Jasmani, Olah Raga, dan Kesehatan',
      'model' => 'sport',
    ],
    [
      'name' => 'Muatan Lokal Bahasa dan Sastra Sunda/Cirebonan',
      'model' => 'local_wisdom',
    ]
  ];

  $kelompokC = [
    [
      'name' => '..............................',
      'model' => 'interest',
    ],
  ];

  $kelompokD = [
    [
      'name' => '..............................',
      'model' => 'independence',
    ],
  ];

  $kelompokE = [
    [
      'name' => 'Program Khusus',
      'model' => 'extraordinary',
    ],
  ]
@endphp

<form wire:submit.prevent="submit">
<div class="max-h-screen overflow-y-auto" id="content-to-pdf">
    <!-- Header -->
    <div class="flex">
      <table class="w-1/2 border-gray-300">
          <tbody>
              <!-- Nama -->
              <tr>
                  <td class="w-1/2 p-2 font-bold">Nama</td>
                  <td class="w-1/2 p-2 font-bold">
                    <x-filament::input.wrapper class="w-full">
                      <x-filament::input.select wire:model="user_id" required>
                        @foreach ($students as $student)
                          <option value="{{ $student->id }}">{{ $student->name }}</option>
                        @endforeach
                      </x-filament::input.select>
                    </x-filament::input.wrapper>
                  </td>
              </tr>

              <!-- NISN -->
              <tr>
                  <td class="w-1/2 p-2 font-bold">Nomor Induk / NISN</td>
                  <td class="w-1/2 p-2 font-bold">
                    <x-filament::input.wrapper class="w-full">
                      <x-filament::input type="text" wire:model="nisn" required/>
                    </x-filament::input.wrapper>
                  </td>
              </tr>
          </tbody>
      </table>

      <table class="w-1/2 border-collapse border-gray-300">
          <tbody>
              <!-- Kelas -->
              <tr>
                  <td class="w-1/2 p-2 font-bold">Kelas</td>
                  <td class="w-1/2 p-2 font-bold">
                    <x-filament::input.wrapper class="w-full">
                      <x-filament::input type="text" wire:model="class" required/>
                    </x-filament::input.wrapper>
                  </td>
              </tr>

              <!-- Semester -->
              <tr>
                <td class="w-1/2 p-2 font-bold">Semester</td>
                <td class="w-1/2 p-2 font-bold">
                  <x-filament::input.wrapper class="w-full">
                    <x-filament::input type="text" wire:model="semester" required/>
                  </x-filament::input.wrapper>
                </td>
              </tr>

              <!-- Tahun Pelajaran -->
              <tr>
                <td class="w-1/2 p-2 font-bold">Tahun Pelajaran</td>
                  <td class="w-1/2 p-2 font-bold">
                    <x-filament::input.wrapper class="w-full">
                      <x-filament::input type="text" wire:model="year" required/>
                    </x-filament::input.wrapper>
                  </td>
              </tr>
          </tbody>
      </table>
    </div>

    <!-- Sikap Section -->
    <h2 class="font-bold">A. Sikap</h2>
    <h3 class="font-bold mt-3">Sikap Spiritual</h3>
    <textarea rows="5" wire:model="spiritual_attitude" id="ta-sikap-spiritual" class="rounded mt-1
    fi-input block w-full py-1.5 text-base text-gray-950 transition duration-75 placeholder:text-gray-400 focus:ring-0 disabled:text-gray-500 disabled:[-webkit-text-fill-color:theme(colors.gray.500)] disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.400)] dark:text-white dark:placeholder:text-gray-500 dark:disabled:text-gray-400 dark:disabled:[-webkit-text-fill-color:theme(colors.gray.400)] dark:disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.500)] sm:text-sm sm:leading-6 bg-white/0 ps-3 pe-3">
    </textarea>
    
    <h3 class="font-bold mt-3">Sikap Sosial</h3>
    <textarea rows="5" wire:model="social_attitude" id="ta-sikap-sosial" class="rounded mt-1
    fi-input block w-full py-1.5 text-base text-gray-950 transition duration-75 placeholder:text-gray-400 focus:ring-0 disabled:text-gray-500 disabled:[-webkit-text-fill-color:theme(colors.gray.500)] disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.400)] dark:text-white dark:placeholder:text-gray-500 dark:disabled:text-gray-400 dark:disabled:[-webkit-text-fill-color:theme(colors.gray.400)] dark:disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.500)] sm:text-sm sm:leading-6 bg-white/0 ps-3 pe-3">
    </textarea>
    
    <!-- Pengetahuan dan Keterampilan Section -->
    <h2 class="font-bold mt-6">B. Pengetahuan dan Keterampilan</h2>
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
                <td class="border border-gray-300 p-2 text-center">
                  <x-filament::input.wrapper class="w-20">
                      <x-filament::input
                          type="text"
                          wire:model="{{ $subject['model'] . '_knowledge' }}"
                          name="{{ $subject['model'] . '_knowledge' }}"
                      />
                  </x-filament::input.wrapper>
                  {{-- <x-filament::input type="text" name="kelompokA[]" class="w-20 rounded"></x-filament::input> --}}
                </td>
                <td class="border border-gray-300 p-2 text-center">
                  <x-filament::input.wrapper class="w-20">
                      <x-filament::input
                          type="text"
                          name="{{ $subject['model'] . '_knowledge_letter' }}"
                          disabled
                      />
                  </x-filament::input.wrapper>
                </td>
                <td class="border border-gray-300 p-2 text-center">
                  <x-filament::input.wrapper class="w-20">
                      <x-filament::input
                          type="text"
                          wire:model="{{ $subject['model'] . '_skill' }}"
                          name="{{ $subject['model'] . '_skill' }}"
                      />
                  </x-filament::input.wrapper>
                  {{-- <input type="text" name="kelompokA[]" class="w-20 rounded"> --}}
                </td>
                <td class="border border-gray-300 p-2 text-center">
                  <x-filament::input.wrapper class="w-20">
                      <x-filament::input
                          type="text"
                          name="{{ $subject['model'] . '_skill_letter' }}"
                          disabled
                      />
                  </x-filament::input.wrapper>
                  {{-- <input type="text" name="kelompokA[]" class="w-20 rounded"> --}}
                </td>
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
                <td class="border border-gray-300 p-2 text-center">
                  <x-filament::input.wrapper class="w-20">
                      <x-filament::input
                          type="text"
                          wire:model="{{ $subject['model'] . '_knowledge' }}"
                          name="{{ $subject['model'] . '_knowledge' }}"
                      />
                  </x-filament::input.wrapper>
                </td>
                <td class="border border-gray-300 p-2 text-center">
                  <x-filament::input.wrapper class="w-20">
                      <x-filament::input
                          type="text"
                          name="{{ $subject['model'] . '_knowledge_letter' }}"
                          disabled
                      />
                  </x-filament::input.wrapper>
                </td>
                <td class="border border-gray-300 p-2 text-center">
                  <x-filament::input.wrapper class="w-20">
                      <x-filament::input
                          type="text"
                          wire:model="{{ $subject['model'] . '_skill' }}"
                          name="{{ $subject['model'] . '_skill' }}"
                      />
                  </x-filament::input.wrapper>
                </td>
                <td class="border border-gray-300 p-2 text-center">
                  <x-filament::input.wrapper class="w-20">
                      <x-filament::input
                          type="text"
                          name="{{ $subject['model'] . '_skill_letter' }}"
                          disabled
                      />
                  </x-filament::input.wrapper>
                </td>
            </tr>
            @endforeach


            <!-- Kelompok C (Pilihan Peminatan) -->
            <tr>
                <td colspan="6" class="border border-gray-300 p-2 font-bold">Kelompok C (Pilihan Peminatan)</td>
            </tr>
            @foreach ($kelompokC as $index => $subject)
            <tr>
                <td class="border border-gray-300 p-2">{{ $index + 1 }}</td>
                <td class="border border-gray-300 p-2 text-center">
                  <x-filament::input.wrapper class="w-full">
                      <x-filament::input
                          type="text"
                          wire:model="interest_subject"
                          value=""
                      />
                  </x-filament::input.wrapper>
                </td>
                <td class="border border-gray-300 p-2 text-center">
                  <x-filament::input.wrapper class="w-20">
                      <x-filament::input
                          type="text"
                          wire:model="{{ $subject['model'] . '_knowledge' }}"
                          name="{{ $subject['model'] . '_knowledge' }}"
                          value="0"
                      />
                  </x-filament::input.wrapper>
                </td>
                <td class="border border-gray-300 p-2 text-center">
                  <x-filament::input.wrapper class="w-20">
                      <x-filament::input
                          type="text"
                          name="{{ $subject['model'] . '_knowledge_letter' }}"
                          disabled
                      />
                  </x-filament::input.wrapper>
                </td>
                <td class="border border-gray-300 p-2 text-center">
                  <x-filament::input.wrapper class="w-20">
                      <x-filament::input
                          type="text"
                          wire:model="{{ $subject['model'] . '_skill' }}"
                          name="{{ $subject['model'] . '_skill' }}"
                          value="0"
                      />
                  </x-filament::input.wrapper>
                </td>
                <td class="border border-gray-300 p-2 text-center">
                  <x-filament::input.wrapper class="w-20">
                      <x-filament::input
                          type="text"
                          name="{{ $subject['model'] . '_skill_letter' }}"
                          disabled
                      />
                  </x-filament::input.wrapper>
                </td>
            </tr>
            @endforeach


            <!-- Kelompok D (Pilihan Kemandirian) -->
            <tr>
                <td colspan="6" class="border border-gray-300 p-2 font-bold">Kelompok D (Pilihan Kemandirian)</td>
            </tr>
            @foreach ($kelompokD as $index => $subject)
            <tr>
                <td class="border border-gray-300 p-2">{{ $index + 1 }}</td>
                <td class="border border-gray-300 p-2 text-center">
                  <x-filament::input.wrapper class="w-full">
                      <x-filament::input
                          type="text"
                          wire:model="independence_subject"
                          value=""
                      />
                  </x-filament::input.wrapper>
                </td>
                <td class="border border-gray-300 p-2 text-center">
                  <x-filament::input.wrapper class="w-20">
                      <x-filament::input
                          type="text"
                          wire:model="{{ $subject['model'] . '_knowledge' }}"
                          name="{{ $subject['model'] . '_knowledge' }}"
                          value="0"
                      />
                  </x-filament::input.wrapper>
                </td>
                <td class="border border-gray-300 p-2 text-center">
                  <x-filament::input.wrapper class="w-20">
                      <x-filament::input
                          type="text"
                          name="{{ $subject['model'] . '_knowledge_letter' }}"
                          disabled
                      />
                  </x-filament::input.wrapper>
                </td>
                <td class="border border-gray-300 p-2 text-center">
                  <x-filament::input.wrapper class="w-20">
                      <x-filament::input
                          type="text"
                          wire:model="{{ $subject['model'] . '_skill' }}"
                          name="{{ $subject['model'] . '_skill' }}"
                          value="0"
                      />
                  </x-filament::input.wrapper>
                </td>
                <td class="border border-gray-300 p-2 text-center">
                  <x-filament::input.wrapper class="w-20">
                      <x-filament::input
                          type="text"
                          name="{{ $subject['model'] . '_skill_letter' }}"
                          disabled
                      />
                  </x-filament::input.wrapper>
                </td>
            </tr>
            @endforeach

            <!-- Kelompok E (Program Kebutuhan Khusus) -->
            <tr>
                <td colspan="6" class="border border-gray-300 p-2 font-bold">Kelompok E (Program Kebutuhan Khusus)</td>
            </tr>
            @foreach ($kelompokE as $index => $subject)
            <tr>
                <td class="border border-gray-300 p-2">{{ $index + 1 }}</td>
                <td class="border border-gray-300 p-2">{{ $subject['name'] }}</td>
                <td class="border border-gray-300 p-2 text-center">
                  <x-filament::input.wrapper class="w-20">
                      <x-filament::input
                          type="text"
                          wire:model="{{ $subject['model'] . '_knowledge' }}"
                          name="{{ $subject['model'] . '_knowledge' }}"
                      />
                  </x-filament::input.wrapper>
                </td>
                <td class="border border-gray-300 p-2 text-center">
                  <x-filament::input.wrapper class="w-20">
                      <x-filament::input
                          type="text"
                          name="{{ $subject['model'] . '_knowledge_letter' }}"
                          disabled
                      />
                  </x-filament::input.wrapper>
                </td>
                <td class="border border-gray-300 p-2 text-center">
                  <x-filament::input.wrapper class="w-20">
                      <x-filament::input
                          type="text"
                          wire:model="{{ $subject['model'] . '_skill' }}"
                          name="{{ $subject['model'] . '_skill' }}"
                      />
                  </x-filament::input.wrapper>
                </td>
                <td class="border border-gray-300 p-2 text-center">
                  <x-filament::input.wrapper class="w-20">
                      <x-filament::input
                          type="text"
                          name="{{ $subject['model'] . '_skill_letter' }}"
                          disabled
                      />
                  </x-filament::input.wrapper>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pengetahuan dan Keterampilan Section -->
    <h2 class="font-bold mt-6">Deskripsi Pengetahuan dan Keterampilan</h2>
    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr>
                <th class="border border-gray-300 p-2">No</th>
                <th class="border border-gray-300 p-2">Mata Pelajaran</th>
                <th class="border border-gray-300 p-2">Kompetensi</th>
                <th class="border border-gray-300 p-2">Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            <!-- Kelompok A (Wajib) -->
            <tr>
                <td colspan="4" class="border border-gray-300 p-2 font-bold">Kelompok A (Wajib)</td>
            </tr>

            @foreach ($kelompokA as $index => $subject)
              <tr>
                  <td rowspan="2" class="border border-gray-300 p-2">{{ $index + 1 }}</td>
                  <td rowspan="2" class="border border-gray-300 p-2">{{ $subject['name'] }}</td>
                  <td class="border border-gray-300 p-2">Pengetahuan</td>
                  <td class="border border-gray-300 p-2 w-1/2">
                    <textarea rows="4" wire:model="{{ $subject['model'] . '_knowledge_description' }}" class="rounded mt-1
                    fi-input block py-1.5 text-base text-gray-950 transition duration-75 placeholder:text-gray-400 focus:ring-0 disabled:text-gray-500 disabled:[-webkit-text-fill-color:theme(colors.gray.500)] disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.400)] dark:text-white dark:placeholder:text-gray-500 dark:disabled:text-gray-400 dark:disabled:[-webkit-text-fill-color:theme(colors.gray.400)] dark:disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.500)] sm:text-sm sm:leading-6 bg-white/0 ps-3 pe-3">
                    </textarea>
                  </td>
              </tr>
              <tr>
                  <td class="border border-gray-300 p-2">Keterampilan</td>
                  <td class="border border-gray-300 p-2">
                    <textarea rows="4" wire:model="{{ $subject['model'] . '_skill_description' }}" class="rounded mt-1
                    fi-input block py-1.5 text-base text-gray-950 transition duration-75 placeholder:text-gray-400 focus:ring-0 disabled:text-gray-500 disabled:[-webkit-text-fill-color:theme(colors.gray.500)] disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.400)] dark:text-white dark:placeholder:text-gray-500 dark:disabled:text-gray-400 dark:disabled:[-webkit-text-fill-color:theme(colors.gray.400)] dark:disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.500)] sm:text-sm sm:leading-6 bg-white/0 ps-3 pe-3">
                    </textarea>
                  </td>
              </tr>
            @endforeach

            <!-- Kelompok B Section -->
            <tr>
                <td colspan="4" class="border border-gray-300 p-2 font-bold">Kelompok B (Wajib)</td>
            </tr>

            @foreach ($kelompokB as $index => $subject)
              <tr>
                  <td rowspan="2" class="border border-gray-300 p-2">{{ $index + 1 }}</td>
                  <td rowspan="2" class="border border-gray-300 p-2">{{ $subject['name'] }}</td>
                  <td class="border border-gray-300 p-2">Pengetahuan</td>
                  <td class="border border-gray-300 p-2">
                    <textarea rows="4" wire:model="{{ $subject['model'] . '_knowledge_description' }}" class="rounded mt-1
                    fi-input block py-1.5 text-base text-gray-950 transition duration-75 placeholder:text-gray-400 focus:ring-0 disabled:text-gray-500 disabled:[-webkit-text-fill-color:theme(colors.gray.500)] disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.400)] dark:text-white dark:placeholder:text-gray-500 dark:disabled:text-gray-400 dark:disabled:[-webkit-text-fill-color:theme(colors.gray.400)] dark:disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.500)] sm:text-sm sm:leading-6 bg-white/0 ps-3 pe-3">
                    </textarea>
                  </td>
              </tr>
              <tr>
                  <td class="border border-gray-300 p-2">Keterampilan</td>
                  <td class="border border-gray-300 p-2">
                    <textarea rows="4" wire:model="{{ $subject['model'] . '_skill_description' }}" class="rounded mt-1
                    fi-input block py-1.5 text-base text-gray-950 transition duration-75 placeholder:text-gray-400 focus:ring-0 disabled:text-gray-500 disabled:[-webkit-text-fill-color:theme(colors.gray.500)] disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.400)] dark:text-white dark:placeholder:text-gray-500 dark:disabled:text-gray-400 dark:disabled:[-webkit-text-fill-color:theme(colors.gray.400)] dark:disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.500)] sm:text-sm sm:leading-6 bg-white/0 ps-3 pe-3">
                    </textarea>
                  </td>
              </tr>
            @endforeach

            <!-- Kelompok C Section -->
            {{-- <tr>
                <td colspan="4" class="border border-gray-300 p-2 font-bold">Kelompok C (Pilihan Peminatan)</td>
            </tr>

            <tr>
                <td rowspan="2" class="border border-gray-300 p-2">1</td>
                <td rowspan="2" class="border border-gray-300 p-2">Program Khusus Bina Diri</td>
                <td class="border border-gray-300 p-2">Pengetahuan</td>
                <td class="border border-gray-300 p-2">
                  <ul>
                    <li>Mengenal peralatan untuk membersihkan kelas menyapu dan mengepel</li>
                    <p>"Peserta didik mampu mandiri mengenal peralatan bersih-bersih"</p>
                  </ul>
                </td>
            </tr>
            <tr>
                <td class="border border-gray-300 p-2">Keterampilan</td>
                <td class="border border-gray-300 p-2">
                  <ul>
                    <li>Menyapu dan mengepel kelas dengan bersih</li>
                    <p>"Peserta didik mampu mandiri menyapu dan mengepel kelas"</p>
                  </ul>
                </td>
            </tr> --}}
        </tbody>
    </table>


    <h2 class="font-bold mt-6">C. Ketidakhadiran</h2>
    <table class="w-1/4 border-collapse border border-gray-300">
        <tbody>
            <!-- Sakit -->
            <tr>
                <td colspan="6" class="border border-gray-300 p-2 font-bold">Sakit</td>
                <td colspan="6" class="border border-gray-300 p-2 font-bold">
                  <x-filament::input.wrapper>
                      <x-filament::input
                          type="text"
                          wire:model="sick"
                          value="0"
                          required
                      />
                      <x-slot name="suffix">Hari</x-slot>
                  </x-filament::input.wrapper>
                </td>
            </tr>

            <!-- Izin -->
            <tr>
                <td colspan="6" class="border border-gray-300 p-2 font-bold">Izin</td>
                <td colspan="6" class="border border-gray-300 p-2 font-bold">
                  <x-filament::input.wrapper>
                      <x-filament::input
                          type="text"
                          wire:model="permission"
                          value="0"
                          required
                      />
                      <x-slot name="suffix">Hari</x-slot>
                  </x-filament::input.wrapper>
                </td>
            </tr>

            <!-- Tanpa Keterangan -->
            <tr>
                <td colspan="6" class="border border-gray-300 p-2 font-bold">Tanpa Keterangan</td>
                <td colspan="6" class="border border-gray-300 p-2 font-bold">
                  <x-filament::input.wrapper>
                      <x-filament::input
                          type="text"
                          wire:model="absent"
                          value="0"
                          required
                      />
                      <x-slot name="suffix">Hari</x-slot>
                  </x-filament::input.wrapper>
                </td>
            </tr>
        </tbody>
    </table>

    <h3 class="font-bold mt-3">Catatan Wali Kelas</h3>
    <textarea rows="5" wire:model="homeroom_notes" id="ta-catatan-wali" class="rounded mt-1
    fi-input block w-full py-1.5 text-base text-gray-950 transition duration-75 placeholder:text-gray-400 focus:ring-0 disabled:text-gray-500 disabled:[-webkit-text-fill-color:theme(colors.gray.500)] disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.400)] dark:text-white dark:placeholder:text-gray-500 dark:disabled:text-gray-400 dark:disabled:[-webkit-text-fill-color:theme(colors.gray.400)] dark:disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.500)] sm:text-sm sm:leading-6 bg-white/0 ps-3 pe-3">
    </textarea>
    
    <h3 class="font-bold mt-3">Tanggapan Orang Tua</h3>
    <textarea rows="5" wire:model="parental_response" id="ta-tanggapan-ortu" class="rounded mt-1
    fi-input block w-full py-1.5 text-base text-gray-950 transition duration-75 placeholder:text-gray-400 focus:ring-0 disabled:text-gray-500 disabled:[-webkit-text-fill-color:theme(colors.gray.500)] disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.400)] dark:text-white dark:placeholder:text-gray-500 dark:disabled:text-gray-400 dark:disabled:[-webkit-text-fill-color:theme(colors.gray.400)] dark:disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.500)] sm:text-sm sm:leading-6 bg-white/0 ps-3 pe-3">
    </textarea>
</div>

{{-- onclick="window.location.href='{{ route('studentreport.pdf') }}'" --}}
<div class="mt-6">
  <x-filament::button type="submit" color="primary" >Save</x-filament::button>
</div>
</form>

<script>
    // Function to convert number to letter grade
    function numberToLetterGrade(value) {
        if (value >= 80.5) return 'A';
        if (value >= 65.5) return 'B';
        if (value >= 50.5) return 'C';
        if (value > 0) return 'D';
        return '-';
    }

    let subjects = [
      'religion',
      'nation',
      'indonesia',
      'math',
      'english',
      'science',
      'social',

      'art',
      'sport',
      'local_wisdom',

      'independence',
      'interest',

      'extraordinary',
    ]
    
    setTimeout(() => {
      subjects.forEach(function(subject) {
          const knowledgeInput = document.querySelector(`input[name="${subject}_knowledge"]`);
          const skillInput = document.querySelector(`input[name="${subject}_skill"]`);

          if (knowledgeInput) {
              const value = parseFloat(knowledgeInput.value);
              console.log(value);
              const letterInput = document.querySelector(`input[name="${subject}_knowledge_letter"]`);
              letterInput.value = numberToLetterGrade(value);

              knowledgeInput.addEventListener('change', function() {
                  const value = parseFloat(this.value);
                  const letterInput = document.querySelector(`input[name="${subject}_knowledge_letter"]`);
                  letterInput.value = numberToLetterGrade(value);
              });
          }

          if (skillInput) {
              const value = parseFloat(skillInput.value);
              const letterInput = document.querySelector(`input[name="${subject}_skill_letter"]`);
              letterInput.value = numberToLetterGrade(value);

              skillInput.addEventListener('change', function() {
                  const value = parseFloat(this.value);
                  const letterInput = document.querySelector(`input[name="${subject}_skill_letter"]`);
                  letterInput.value = numberToLetterGrade(value);
              });
          }
      });
    }, 1000);
    

</script>

</x-filament-panels::page>
