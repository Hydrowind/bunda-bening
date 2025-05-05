@extends('layouts.pdf')

@section('body')
@php

  // Function to convert number to letter grade
  function numberToLetterGrade($value) {
    if ($value >= 80.5) return 'A';
    if ($value >= 65.5) return 'B';
    if ($value >= 50.5) return 'C';
    if ($value > 0) return 'D';
    return '-';
  }

  $kelompokAMapel= [
    'Pendidikan Agama dan Budi Pekerti',
    'Pendidikan Pancasila dan Kewarganegaraan',
    'Bahasa Indonesia',
    'Matematika',
    'Ilmu Pengetahuan Alam',
    'Ilmu Pengetahuan Sosial',
    'Bahasa Inggris'
  ];

  $kelompokA = [];
  $data = [];
  $j=0;
  for($i = 0; $i < count($_GET['knowledgeA']); $i++) {
    $knowledgeScore = $_GET['knowledgeA'][$i];
    $skillScore = $_GET['skillA'][$i];

    $data['name'] = $kelompokAMapel[$j++];
    $data['knowledge_score'] =$knowledgeScore;
    $data['knowledge_grade'] = numberToLetterGrade($knowledgeScore);
    $data['skill_score'] = $skillScore;
    $data['skill_grade'] = numberToLetterGrade($skillScore);

    array_push($kelompokA, $data);
  }

  $kelompokBMapel = [
    'Seni Budaya dan Prakarya',
    'Pendidikan Jasmani, Olahraga dan Kesehatan',
    'Muatan Lokal Bahasa dan Sastra Sunda/Cirebonan'
  ];
  $kelompokB = [];
  $data = [];
  $j=0;
  for($i = 0; $i < count($_GET['knowledgeB']); $i++) {
    $knowledgeScore = $_GET['knowledgeB'][$i];
    $skillScore = $_GET['skillB'][$i];

    $data['name'] = $kelompokBMapel[$j++];
    $data['knowledge_score'] =$knowledgeScore;
    $data['knowledge_grade'] = numberToLetterGrade($knowledgeScore);
    $data['skill_score'] = $skillScore;
    $data['skill_grade'] = numberToLetterGrade($skillScore);

    array_push($kelompokB, $data);
  }

  $kelompokC = [];
  $data = [];
  for($i = 0; $i < count($_GET['knowledgeC']); $i++) {
    $knowledgeScore = $_GET['knowledgeC'][$i];
    $skillScore = $_GET['skillC'][$i];

    $data['name'] = $_GET['kelompokCMapel'];
    $data['knowledge_score'] =$knowledgeScore;
    $data['knowledge_grade'] = numberToLetterGrade($knowledgeScore);
    $data['skill_score'] = $skillScore;
    $data['skill_grade'] = numberToLetterGrade($skillScore);

    array_push($kelompokC, $data);
  }

  $kelompokD = [];
  $data = [];
  for($i = 0; $i < count($_GET['knowledgeD']); $i++) {
    $knowledgeScore = $_GET['knowledgeD'][$i];
    $skillScore = $_GET['skillD'][$i];

    $data['name'] = $_GET['kelompokDMapel'];
    $data['knowledge_score'] =$knowledgeScore;
    $data['knowledge_grade'] = numberToLetterGrade($knowledgeScore);
    $data['skill_score'] = $skillScore;
    $data['skill_grade'] = numberToLetterGrade($skillScore);

    array_push($kelompokD, $data);
  }

  $kelompokEMapel = [
    'Program Khusus Bina Diri'
  ];
  $kelompokE = [];
  $data = [];
  $j=0;
  for($i = 0; $i < count($_GET['knowledgeE']); $i++) {
    $knowledgeScore = $_GET['knowledgeE'][$i];
    $skillScore = $_GET['skillE'][$i];

    $data['name'] = $kelompokEMapel[$j++];
    $data['knowledge_score'] =$knowledgeScore;
    $data['knowledge_grade'] = numberToLetterGrade($knowledgeScore);
    $data['skill_score'] = $skillScore;
    $data['skill_grade'] = numberToLetterGrade($skillScore);

    array_push($kelompokE, $data);
  }
@endphp

<div>
<!-- Header -->
    <div class="flex">
      <table class="w-1/2 border-gray-300">
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
                <td class="w-1/2 p-2 font-bold">{{ $_GET['nama'] }}</td>
            </tr>

            <!-- NISN -->
            <tr>
                <td class="w-1/2 p-2 font-bold">Nomor Induk / NISN</td>
                <td class="w-1/2 p-2 font-bold">{{ $_GET['nisn'] }}</td>
            </tr>
          </tbody>
      </table>

      <table class="w-1/2 border-collapse border-gray-300">
          <tbody>
              <!-- Kelas -->
              <tr>
                  <td class="w-1/2 p-2 font-bold">Kelas</td>
                  <td class="w-1/2 p-2 font-bold">{{ $_GET['kelas'] }}</td>
              </tr>

              <!-- Semester -->
              <tr>
                <td class="w-1/2 p-2 font-bold">Semester</td>
                <td class="w-1/2 p-2 font-bold">{{ $_GET['semester'] }}</td>
              </tr>

              <!-- Tahun Pelajaran -->
              <tr>
                <td class="w-1/2 p-2 font-bold">Tahun Pelajaran</td>
                <td class="w-1/2 p-2 font-bold">{{ $_GET['tahun'] }}</td>
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
    <p>{{ $_GET['sikap-spiritual'] }}</p>
    
    <h3 class="font-bold mt-3">Sikap Sosial</h3>
    <p>{{ $_GET['sikap-sosial'] }}</p>
    
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


            <!-- Kelompok C (Pilihan Peminatan) -->
            <tr>
                <td colspan="6" class="border border-gray-300 p-2 font-bold">Kelompok C (Pilihan Peminatan)</td>
            </tr>
            @foreach ($kelompokC as $index => $subject)
            <tr>
                <td class="border border-gray-300 p-2">{{ $index + 1 }}</td>
                <td class="border border-gray-300 p-2">{{ $subject['name'] }}</td>
                <td class="border border-gray-300 p-2">{{ $subject['knowledge_score'] }}</td>
                <td class="border border-gray-300 p-2">{{ $subject['knowledge_grade'] }}</td>
                <td class="border border-gray-300 p-2">{{ $subject['skill_score'] }}</td>
                <td class="border border-gray-300 p-2">{{ $subject['skill_grade'] }}</td>
            </tr>
            @endforeach


            <!-- Kelompok D (Pilihan Kemandirian) -->
            <tr>
                <td colspan="6" class="border border-gray-300 p-2 font-bold">Kelompok D (Pilihan Kemandirian)</td>
            </tr>
            @foreach ($kelompokD as $index => $subject)
            <tr>
                <td class="border border-gray-300 p-2">{{ $index + 1 }}</td>
                <td class="border border-gray-300 p-2">{{ $subject['name'] }}</td>
                <td class="border border-gray-300 p-2">{{ $subject['knowledge_score'] }}</td>
                <td class="border border-gray-300 p-2">{{ $subject['knowledge_grade'] }}</td>
                <td class="border border-gray-300 p-2">{{ $subject['skill_score'] }}</td>
                <td class="border border-gray-300 p-2">{{ $subject['skill_grade'] }}</td>
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
                <td class="border border-gray-300 p-2">{{ $subject['knowledge_score'] }}</td>
                <td class="border border-gray-300 p-2">{{ $subject['knowledge_grade'] }}</td>
                <td class="border border-gray-300 p-2">{{ $subject['skill_score'] }}</td>
                <td class="border border-gray-300 p-2">{{ $subject['skill_grade'] }}</td>
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
            <tr>
                <td rowspan="2" class="border border-gray-300 p-2">1</td>
                <td rowspan="2" class="border border-gray-300 p-2">Pendidikan Agama dan Budi Pekerti</td>
                <td class="border border-gray-300 p-2">Pengetahuan</td>
                <td class="border border-gray-300 p-2">
                  <ul>
                    <li>Memahami Surah Al-Fatihah</li>
                    <p>"Peserta didik mampu memahami surat Al-Fatihah dengan sedikit bantuan"</p>

                    <li>Memahami Rukun Iman</li>
                    <p>"Peserta didik mampu dengan bimbingan untuk memahami rukun iman"</p>
                  </ul>
                </td>
            </tr>
            <tr>
                <td class="border border-gray-300 p-2">Keterampilan</td>
                <td class="border border-gray-300 p-2">
                  <ul>
                    <li>Menyalin Surah Al-Fatihah</li>
                    <p>"Peserta didik mampu mandiri untuk menyalin surat Al-Fatihah"</p>
                  </ul>
                </td>
            </tr>


            <tr>
                <td rowspan="2" class="border border-gray-300 p-2">2</td>
                <td rowspan="2" class="border border-gray-300 p-2">Pendidikan Pancasila dan Kewarganegaraan</td>
                <td class="border border-gray-300 p-2">Pengetahuan</td>
                <td class="border border-gray-300 p-2">
                  <ul>
                    <li>Mengenal nama dan gambar lambang negara indonesia</li>
                    <p>"Peserta didik mampu memahami surat Al-Fatihah dengan sedikit bantuan"</p>

                    <li>Memahami Rukun Iman</li>
                    <p>"Peserta didik mampu dengan bimbingan untuk memahami rukun iman"</p>
                  </ul>
                </td>
            </tr>
            <tr>
                <td class="border border-gray-300 p-2">Keterampilan</td>
                <td class="border border-gray-300 p-2">
                  <ul>
                    <li>Menyalin Surah Al-Fatihah</li>
                    <p>"Peserta didik mampu mandiri untuk menyalin surat Al-Fatihah"</p>
                  </ul>
                </td>
            </tr>

            <tr>
                <td rowspan="2" class="border border-gray-300 p-2">3</td>
                <td rowspan="2" class="border border-gray-300 p-2">Bahasa Indonesia</td>
                <td class="border border-gray-300 p-2">Pengetahuan</td>
                <td class="border border-gray-300 p-2">
                  <ul>
                    <li>Mengenal huruf-huruf abjad dalam bahasa indonesia</li>
                    <p>"Peserta didik mampu mengenal huruf abjad dengan bantuan"</p>

                    <li>Mengenal bunyi bahasa indonesia</li>
                    <p>"Peserta didik mampu mengenal bunyi bahasa indonesia dengan bimbingan"</p>
                  </ul>
                </td>
            </tr>
            <tr>
                <td class="border border-gray-300 p-2">Keterampilan</td>
                <td class="border border-gray-300 p-2">
                  <ul>
                    <li>Menyalin huruf-huruf abjad dalam bahasa indonesia</li>
                    <p>"Peserta didik mampu menyalin huruf abjad dengan mandiri"</p>
                  </ul>
                </td>
            </tr>

            <tr>
                <td rowspan="2" class="border border-gray-300 p-2">4</td> 
                <td rowspan="2" class="border border-gray-300 p-2">Matematika</td>
                <td class="border border-gray-300 p-2">Pengetahuan</td>
                <td class="border border-gray-300 p-2">
                  <ul>
                    <li>Mengenal bilangan asli sampai 10 dengan menggunakan benda konkret</li>
                    <p>"Peserta didik mampu mengenal bilangan 1-10 dengan bantuan"</p>

                    <li>Mengenal bangun datar dan bangun ruang dengan menggunakan berbagai benda konkret</li>
                    <p>"Peserta didik mampu mengenal bangun datar dengan bimbingan"</p>
                  </ul>
                </td>
            </tr>
            <tr>
                <td class="border border-gray-300 p-2">Keterampilan</td>  
                <td class="border border-gray-300 p-2">
                  <ul>
                    <li>Menuliskan bilangan asli sampai 10</li>
                    <p>"Peserta didik mampu menuliskan bilangan 1-10 dengan mandiri"</p>

                    <li>Mengelompokkan bangun datar dan bangun ruang</li>
                    <p>"Peserta didik mampu mengelompokkan bangun datar dengan bantuan"</p>
                  </ul>
                </td>
            </tr>

            <tr>
                <td rowspan="2" class="border border-gray-300 p-2">5</td>
                <td rowspan="2" class="border border-gray-300 p-2">Ilmu Pengetahuan Alam</td>
                <td class="border border-gray-300 p-2">Pengetahuan</td>
                <td class="border border-gray-300 p-2">
                  <ul>
                    <li>Mengenal makhluk hidup dan lingkungan sekitar</li>
                    <p>"Peserta didik mampu mengenal makhluk hidup dengan bantuan"</p>

                    <li>Memahami perubahan wujud benda</li>
                    <p>"Peserta didik mampu memahami perubahan wujud dengan bimbingan"</p>
                  </ul>
                </td>
            </tr>
            <tr>
                <td class="border border-gray-300 p-2">Keterampilan</td>
                <td class="border border-gray-300 p-2">
                  <ul>
                    <li>Melakukan pengamatan sederhana</li>
                    <p>"Peserta didik mampu melakukan pengamatan dengan mandiri"</p>
                    
                    <li>Melakukan percobaan sederhana</li>
                    <p>"Peserta didik mampu melakukan percobaan dengan bantuan"</p>
                  </ul>
                </td>
            </tr>

            <tr>
                <td rowspan="2" class="border border-gray-300 p-2">6</td>
                <td rowspan="2" class="border border-gray-300 p-2">Ilmu Pengetahuan Sosial</td>
                <td class="border border-gray-300 p-2">Pengetahuan</td>
                <td class="border border-gray-300 p-2">
                  <ul>
                    <li>Mengenal lingkungan keluarga dan sekolah</li>
                    <p>"Peserta didik mampu mengenal lingkungan dengan bantuan"</p>

                    <li>Memahami peran anggota keluarga</li>
                    <p>"Peserta didik mampu memahami peran keluarga dengan bimbingan"</p>
                  </ul>
                </td>
            </tr>
            <tr>
                <td class="border border-gray-300 p-2">Keterampilan</td>
                <td class="border border-gray-300 p-2">
                  <ul>
                    <li>Menceritakan kegiatan sehari-hari</li>
                    <p>"Peserta didik mampu menceritakan kegiatan dengan mandiri"</p>
                    
                    <li>Berinteraksi dengan lingkungan sosial</li>
                    <p>"Peserta didik mampu berinteraksi dengan bantuan"</p>
                  </ul>
                </td>
            </tr>

            <tr>
                <td rowspan="2" class="border border-gray-300 p-2">7</td>
                <td rowspan="2" class="border border-gray-300 p-2">Bahasa Inggris</td>
                <td class="border border-gray-300 p-2">Pengetahuan</td>
                <td class="border border-gray-300 p-2">
                  <ul>
                    <li>Memahami kosakata dasar bahasa Inggris</li>
                    <p>"Peserta didik mampu mengenal kosakata dasar dengan bantuan"</p>

                    <li>Mengenal ungkapan sapaan sederhana</li>
                    <p>"Peserta didik mampu mengenal ungkapan sapaan dengan bimbingan"</p>
                  </ul>
                </td>
            </tr>
            <tr>
                <td class="border border-gray-300 p-2">Keterampilan</td>
                <td class="border border-gray-300 p-2">
                  <ul>
                    <li>Mengucapkan kosakata sederhana</li>
                    <p>"Peserta didik mampu mengucapkan kosakata dengan mandiri"</p>
                    
                    <li>Melakukan percakapan singkat</li>
                    <p>"Peserta didik mampu melakukan percakapan dengan bantuan"</p>
                  </ul>
                </td>
            </tr>

            <div class="page-break"></div>
            <!-- Kelompok B Section -->
            <tr>
                <td colspan="4" class="border border-gray-300 p-2 font-bold">Kelompok B (Wajib)</td>
            </tr>

            <tr>
                <td rowspan="2" class="border border-gray-300 p-2">1</td>
                <td rowspan="2" class="border border-gray-300 p-2">Seni Budaya dan Prakarya</td>
                <td class="border border-gray-300 p-2">Pengetahuan</td>
                <td class="border border-gray-300 p-2">
                  <ul>
                    <li>Mengenal karya seni rupa dua dimensi</li>
                    <p>"Peserta didik mampu mengenal karya seni rupa dua dimensi dengan bantuan"</p>

                    <li>Mengenal lagu-lagu daerah</li>
                    <p>"Peserta didik mampu mengenal lagu daerah dengan bimbingan"</p>
                  </ul>
                </td>
            </tr>
            <tr>
                <td class="border border-gray-300 p-2">Keterampilan</td>
                <td class="border border-gray-300 p-2">
                  <ul>
                    <li>Membuat karya seni rupa dua dimensi</li>
                    <p>"Peserta didik mampu membuat karya seni rupa dua dimensi dengan mandiri"</p>
                    
                    <li>Menyanyikan lagu-lagu daerah</li>
                    <p>"Peserta didik mampu menyanyikan lagu daerah dengan bantuan"</p>
                  </ul>
                </td>
            </tr>

            <tr>
                <td rowspan="2" class="border border-gray-300 p-2">2</td>
                <td rowspan="2" class="border border-gray-300 p-2">Pendidikan Jasmani, Olahraga dan Kesehatan</td>
                <td class="border border-gray-300 p-2">Pengetahuan</td>
                <td class="border border-gray-300 p-2">
                  <ul>
                    <li>Mengetahui bagian-bagian tubuh manusia</li>
                    <p>"Peserta didik mampu mengetahui bagian tubuh dengan bantuan"</p>

                    <li>Mengetahui cara menjaga kebersihan tubuh</li>
                    <p>"Peserta didik mampu mengetahui cara menjaga kebersihan dengan bimbingan"</p>
                  </ul>
                </td>
            </tr>
            <tr>
                <td class="border border-gray-300 p-2">Keterampilan</td>
                <td class="border border-gray-300 p-2">
                  <ul>
                    <li>Mempraktikkan cara menjaga kebersihan tubuh</li>
                    <p>"Peserta didik mampu mempraktikkan cara menjaga kebersihan dengan mandiri"</p>
                    
                    <li>Melakukan gerak dasar lokomotor</li>
                    <p>"Peserta didik mampu melakukan gerak dasar dengan bantuan"</p>
                  </ul>
                </td>
            </tr>

            

            <tr>
                <td rowspan="2" class="border border-gray-300 p-2">3</td>
                <td rowspan="2" class="border border-gray-300 p-2">Muatan Lokal Bahasa dan
Sastra Sunda/Cirebonan</td>
                <td class="border border-gray-300 p-2">Pengetahuan</td>
                <td class="border border-gray-300 p-2">
                  <ul>
                    <li>Mengenal adab sopan santun dalam kehidupan sehari-hari</li>
                    <p>"Peserta didik mampu mandiri untuk mengenal adab sopan santun dalam kehidupan sehari-hari"</p>
                  </ul>
                </td>
            </tr>
            <tr>
                <td class="border border-gray-300 p-2">Keterampilan</td>
                <td class="border border-gray-300 p-2">
                  <ul>
                    <li>Melabel warna, benda, angka, panca indra, buah dan sayuran</li>
                    <p>"Peserta didik mampu mandiri untuk melabel warna, benda, angka, panca indra, buah dan sayuran"</p>
                    
                    <li>Mengelompokan sayuran berdasarkan warnanya</li>
                    <p>"Peserta didik mampu dengan bimbingan untuk mengelompokan sayuran berdasarkan warnanya"</p>
                  </ul>
                </td>
            </tr>

            <!-- Kelompok C Section -->
            <tr>
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
            </tr>
        </t>
    </table>
    <p>Tingkat Pemahaman Siswa: <span class="font-bold">{{ $evaluationResult }}</span></p>
    <p>&nbsp;</p>
    <h2 class="font-bold">C. Ketidakharidan</h2>
    <table class="w-1/2 border-collapse border border-gray-300">
        <tbody>
            <!-- Sakit -->
            <tr>
                <td colspan="6" class="border border-gray-300 p-2 font-bold">Sakit</td>
                <td colspan="6" class="border border-gray-300 p-2 font-bold">{{ $_GET['sakit'] }} Hari</td>
            </tr>

            <!-- Izin -->
            <tr>
                <td colspan="6" class="border border-gray-300 p-2 font-bold">Izin</td>
                <td colspan="6" class="border border-gray-300 p-2 font-bold">{{ $_GET['izin'] }} Hari</td>
            </tr>

            <!-- Tanpa Keterangan -->
            <tr>
                <td colspan="6" class="border border-gray-300 p-2 font-bold">Tanpa Keterangan</td>
                <td colspan="6" class="border border-gray-300 p-2 font-bold">{{ $_GET['alfa'] }} Hari</td>
            </tr>
        </tbody>
    </table>

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
</div>
@endsection