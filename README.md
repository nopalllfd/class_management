Pembagian Tugas :

-SIDQI-
  Folder Tanggung Jawab: frontend/
  Desain UI: Membuat layout halaman, gaya (CSS), dan elemen interaktif (HTML) untuk seluruh aplikasi.
  Logika Frontend: Menulis kode JavaScript untuk berinteraksi dengan API backend yang dibangun oleh Naufal. Ini termasuk:
  Mengambil data dari API dan menampilkannya di halaman.
  Mengirim data dari formulir ke API.
  Menangani respons dari API (menampilkan pesan sukses atau kesalahan).
-FAJAR-
  Folder Tanggung Jawab: backend/config/ dan backend/core/
  Desain Database: Membuat dan mengelola skema database di MariaDB (tabel classes, students, teachers, dan tabel perantara).
  Koneksi Database: Menulis dan memelihara file config/database.php yang berisi kredensial dan fungsi koneksi ke database.
  Membuat Model: Mengembangkan semua kelas di folder core/ (Class.php, Student.php, Teacher.php). Setiap kelas harus berisi properti dan metode untuk melakukan operasi CRUD (Create, Read, Update, Delete) di tabel database yang sesuai.
  Menulis Query SQL: Menulis query SQL yang efisien di dalam metode-metode model untuk mengambil, menambah, mengedit, atau menghapus data. Database.php
-NAUFAL-
  Membuat File API: Mengembangkan semua file di folder api/ (create.php, read.php untuk setiap entitas).
  Validasi Data: Memeriksa data yang dikirim dari frontend untuk memastikan format dan isinya benar sebelum diproses.
  Mengintegrasikan Model: Memanggil metode dari model yang dibuat oleh Fajar untuk melakukan operasi database. Misalnya, di api/student/create.php, ia akan memanggil $student->create() setelah memvalidasi data.
  Menangani Respons: Mengatur respons JSON yang dikirim kembali ke frontend, termasuk pesan sukses, data yang diminta, atau pesan kesalahan jika terjadi masalah.
