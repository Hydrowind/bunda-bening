@extends('layouts.pdf')

@section('body')
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
  ];



  // Function to convert number to letter grade
  function numberToLetterGrade($value) {
    if ($value >= 80.5) return 'A';
    if ($value >= 65.5) return 'B';
    if ($value >= 50.5) return 'C';
    if ($value > 0) return 'D';
    return '-';
  }

@endphp

<style>
  @media screen {
      .print {
          display: none;
      }
  }

  @media print {
     .print {
          display: block;
      }
 }
</style>

<div>
<!-- Header -->
    <div class="flex">
      <table class="w-1/3 border-gray-300">
          <tbody>
            <!-- Nama Sekolah -->
            <tr>
                <td class="w-1/2 p-2 font-bold">Nama Sekolah</td>
                <td class="w-1/2 p-2 font-bold">SLB Autisma Bunda Bening Selakshahati</td>
            </tr>

            <!-- Alamat Sekolah -->
            <tr>
                <td class="w-1/2 p-2 font-bold">Alamat Sekolah</td>
                <td class="w-1/2 p-2 font-bold">kp. Ciburubeet Hilir Ds. Cileunyi Wetan Kec. Cileunyi</td>
            </tr>

            <!-- Nama -->
            <tr>
                <td class="w-1/2 p-2 font-bold">Nama</td>
                <td class="w-1/2 p-2 font-bold">{{ $score->name }}</td>
            </tr>

            <!-- NISN -->
            <tr>
                <td class="w-1/2 p-2 font-bold">Nomor Induk / NISN</td>
                <td class="w-1/2 p-2 font-bold">{{ $score->nisn }}</td>
            </tr>
          </tbody>
      </table>

      <table class="w-1/3 border-collapse border-gray-300">
          <tbody>
              <!-- Kelas -->
              <tr>
                  <td class="w-1/2 p-2 font-bold">Kelas</td>
                  <td class="w-1/2 p-2 font-bold">{{ $score->class }}</td>
              </tr>

              <!-- Semester -->
              <tr>
                <td class="w-1/2 p-2 font-bold">Semester</td>
                <td class="w-1/2 p-2 font-bold">{{ $score->semester }}</td>
              </tr>

              <!-- Tahun Pelajaran -->
              <tr>
                <td class="w-1/2 p-2 font-bold">Tahun Pelajaran</td>
                <td class="w-1/2 p-2 font-bold">{{ $score->year }}</td>
              </tr>
          </tbody>
      </table>
    </div>

    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <h2 class="font-bold text-center">Capaian Hasil Belajar</h2>

    <p>&nbsp;</p>
    <p>&nbsp;</p>

    <!-- Sikap Section -->
    <h2 class="font-bold">A. Sikap</h2>
    <h3 class="font-bold mt-3">Sikap Spiritual</h3>
    <div id="ta-sikap-spiritual" class="rounded mt-1
    fi-input block w-full py-1.5 text-base text-gray-950 transition duration-75 placeholder:text-gray-400 focus:ring-0 disabled:text-gray-500 disabled:[-webkit-text-fill-color:theme(colors.gray.500)] disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.400)] dark:text-white dark:placeholder:text-gray-500 dark:disabled:text-gray-400 dark:disabled:[-webkit-text-fill-color:theme(colors.gray.400)] dark:disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.500)] sm:text-sm sm:leading-6 bg-white/0 ps-3 pe-3">
      {{ $score->spiritual_attitude }}
    </div>
    
    <h3 class="font-bold mt-3">Sikap Sosial</h3>
    <div id="ta-sikap-sosial" class="rounded mt-1
    fi-input block w-full py-1.5 text-base text-gray-950 transition duration-75 placeholder:text-gray-400 focus:ring-0 disabled:text-gray-500 disabled:[-webkit-text-fill-color:theme(colors.gray.500)] disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.400)] dark:text-white dark:placeholder:text-gray-500 dark:disabled:text-gray-400 dark:disabled:[-webkit-text-fill-color:theme(colors.gray.400)] dark:disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.500)] sm:text-sm sm:leading-6 bg-white/0 ps-3 pe-3">
      {{ $score->social_attitude }}
    </div>
    
    <!-- Pengetahuan dan Keterampilan Section -->
    <h2 class="font-bold mt-6">B. Pengetahuan dan Keterampilan</h2>
    <table class="w-full border border-gray-300">
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
                          value="{{ $score[$subject['model'] . '_knowledge'] }}"
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
                          value="{{ $score[$subject['model'] . '_skill'] }}"
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
                          value="{{ $score[$subject['model'] . '_knowledge'] }}"
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
                          value="{{ $score[$subject['model'] . '_skill'] }}"
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
                <td class="border border-gray-300 p-2">
                  <x-filament::input.wrapper class="w-full">
                      <x-filament::input
                          type="text"
                          value="{{ $score[$subject['model'] . '_subject'] }}"
                      />
                  </x-filament::input.wrapper>
                </td>
                <td class="border border-gray-300 p-2 text-center">
                  <x-filament::input.wrapper class="w-20">
                      <x-filament::input
                          type="text"
                          value="{{ $score[$subject['model'] . '_knowledge'] }}"
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
                          value="{{ $score[$subject['model'] . '_skill'] }}"
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
                <td class="border border-gray-300 p-2">
                  <x-filament::input.wrapper class="w-full">
                      <x-filament::input
                          type="text"
                          value="{{ $score[$subject['model'] . '_subject'] }}"
                      />
                  </x-filament::input.wrapper>
                </td>
                <td class="border border-gray-300 p-2 text-center">
                  <x-filament::input.wrapper class="w-20">
                      <x-filament::input
                          type="text"
                          value="{{ $score[$subject['model'] . '_knowledge'] }}"
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
                          value="{{ $score[$subject['model'] . '_skill'] }}"
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
                          value="{{ $score[$subject['model'] . '_knowledge'] }}"
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
                          value="{{ $score[$subject['model'] . '_skill'] }}"
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
                  <td class="border border-gray-300 p-2">
                    {{ $score[$subject['model'] . '_knowledge_description'] }}
                  </td>
              </tr>
              <tr>
                  <td class="border border-gray-300 p-2">Keterampilan</td>
                  <td class="border border-gray-300 p-2">
                    {{ $score[$subject['model'] . '_skill_description'] }}
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
                    {{ $score[$subject['model'] . '_knowledge_description'] }}
                  </td>
              </tr>
              <tr>
                  <td class="border border-gray-300 p-2">Keterampilan</td>
                  <td class="border border-gray-300 p-2">
                    {{ $score[$subject['model'] . '_skill_description'] }}
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

    <p class="mt-4">Tingkat Pemahaman Siswa: <span class="font-bold">{{ $evaluationResult }}</span></p>

    <h2 class="font-bold mt-6">C. Ketidakharidan</h2>
    <table class="w-1/4 border-collapse border border-gray-300">
        <tbody>
            <!-- Sakit -->
            <tr>
                <td colspan="6" class="border border-gray-300 p-2 font-bold">Sakit</td>
                <td colspan="6" class="border border-gray-300 p-2 font-bold">
                  {{ $score->sick }} Hari
                </td>
            </tr>

            <!-- Izin -->
            <tr>
                <td colspan="6" class="border border-gray-300 p-2 font-bold">Izin</td>
                <td colspan="6" class="border border-gray-300 p-2 font-bold">
                  {{ $score->permission }} Hari
                </td>
            </tr>

            <!-- Tanpa Keterangan -->
            <tr>
                <td colspan="6" class="border border-gray-300 p-2 font-bold">Tanpa Keterangan</td>
                <td colspan="6" class="border border-gray-300 p-2 font-bold">
                  {{ $score->absent }} Hari
                </td>
            </tr>
        </tbody>
    </table>

    <h2 class="font-bold mt-6">D. Catatan Wali Kelas</h2>
    <div id="ta-catatan-wali-kelas" class="rounded border mt-1 h-10
    fi-input block w-full py-1.5 text-base text-gray-950 transition duration-75 placeholder:text-gray-400 focus:ring-0 disabled:text-gray-500 disabled:[-webkit-text-fill-color:theme(colors.gray.500)] disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.400)] dark:text-white dark:placeholder:text-gray-500 dark:disabled:text-gray-400 dark:disabled:[-webkit-text-fill-color:theme(colors.gray.400)] dark:disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.500)] sm:text-sm sm:leading-6 bg-white/0 ps-3 pe-3">
      
    </div>

    <h2 class="font-bold mt-6">E. Tanggapan Orang Tua</h2>
    <div id="ta-tanggapan-orang-tua" class="rounded border mt-1 h-10
    fi-input block w-full py-1.5 text-base text-gray-950 transition duration-75 placeholder:text-gray-400 focus:ring-0 disabled:text-gray-500 disabled:[-webkit-text-fill-color:theme(colors.gray.500)] disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.400)] dark:text-white dark:placeholder:text-gray-500 dark:disabled:text-gray-400 dark:disabled:[-webkit-text-fill-color:theme(colors.gray.400)] dark:disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.500)] sm:text-sm sm:leading-6 bg-white/0 ps-3 pe-3">
      
    </div>
    

    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <div class="sign flex justify-between mt-10">
      <div style="float: left;">
        <p>&nbsp;</p>
        <p>Mengetahui,</p>
        <p>Orang Tua/Wali,</p>
        <br>
        <br>
        <p>......................</p>
      </div>
      <div style="float: right;">
        <p>Bandung, 01 April 2025</p>
        <p>&nbsp;</p>
        <p>Guru Kelas</p>
        <br>
        <br>
        <p>......................</p>
      </div>
    </div>

    <br><br>
    <div class="sign flex justify-center align-center">
      <div>
        <p>Berdasarkan hasil yang dicapai pada semester 1 dan 2,</p>
        <p>Peserta didik ditetapkan</p>
        <p>Naik ke kelas&emsp;&emsp;: ...... (...........................)</p>
        <p>Tinggal di kelas&emsp;: ...... (...........................)</p>
      </div>
    </div>

    <br><br>
    <div class="sign flex justify-center align-center">
      <div>
        <p class="text-center">Kepala Sekolah</p>
        <br>
        <br>
        <br>
        <p class="text-center">Nining Honijah, S.Pd.I, M.Pd</p>
        <p class="text-center">NUPTK. 0238748650300063</p>
      </div>
    </div>
    
</div>


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

      window.onload = function() {
        window.print();
      }
</script>

@endsection