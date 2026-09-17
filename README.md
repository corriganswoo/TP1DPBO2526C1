# Tugas Praktikum 1 - Desain dan Pemrograman Berorientasi Objek (DPBO)

## 📌 Janji
"Saya **Irsyad Afif Musyaffa** dengan **NIM 2508023** mengerjakan Tugas Praktikum 1 dalam mata kuliah Desain dan Pemrograman Berorientasi Objek untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin."

---

## 🎬 Fitur Utama Sistem Management Bioskop

* **Tambah Data (Create):** Menambahkan data film baru.
* **Tampilkan Data (Read):** Menampilkan seluruh katalog data film.
* **Ubah Data (Update):** Memperbarui rincian data film yang sudah tersimpan berdasarkan ID.
* **Hapus Data (Delete):** Menghapus data film spesifik dari dalam sistem.
* **Pencarian Data (Search):** Menyaring/mencari data film berdasarkan Kode ID tertentu.

---

## ⚠️ Error Handling

1. **Validasi Input Kosong & Tipe Data:**
   * Mengamankan sistem agar tidak memproses data bernilai kosong atau format harga yang invalid (misal: diisi huruf atau bernilai negatif $\le 0$).
   * Contoh error di program C++:
     
     <img width="511" height="44" alt="image" src="https://github.com/user-attachments/assets/d81461ad-38cd-40ba-8b3e-7dbba5470a0e" />

2. **Pencegahan Duplikasi ID (Primary Key Check):**
   * Menolak penambahan data baru jika Kode ID yang dimasukkan sudah terdaftar sebelumnya di dalam sistem.
   * Contoh error di program java:
     
     <img width="464" height="359" alt="image" src="https://github.com/user-attachments/assets/53daca35-c0c3-43ce-87f1-0ed60b8e4e46" />


## 📁 Dokumentasi Output Program

### 1. C++
* **Menambahkan Data**
  
  <img width="444" height="411" alt="image" src="https://github.com/user-attachments/assets/dc11b944-1da1-4aa3-ab85-f94cf8371fb1" />

* **Menampilkan Data**
  
  <img width="431" height="713" alt="image" src="https://github.com/user-attachments/assets/8105487d-2da7-496f-bc8f-8bb4422de938" />

* **Mengubah Data**
  
  <img width="464" height="438" alt="image" src="https://github.com/user-attachments/assets/4493e03e-e603-4d88-b79a-ceea22c9fdf8" />
  
  Hasil:
  
  <img width="425" height="711" alt="image" src="https://github.com/user-attachments/assets/4fd014d2-8dfb-4b0c-ac35-6ceaaa505b0f" />

* **Menghapus Data**
  
  <img width="445" height="354" alt="image" src="https://github.com/user-attachments/assets/de7d92e3-eaf2-4d4c-a48c-89611232b3c3" />
  
  Hasil:
  
  <img width="438" height="593" alt="image" src="https://github.com/user-attachments/assets/97330117-6bc9-443f-830b-3ccfe6c15316" />

* **Mencari Data**
  
  <img width="435" height="500" alt="image" src="https://github.com/user-attachments/assets/80f7283e-0202-4cb9-8277-6078b34f8b2e" />

---

### 2. Java
* **Menambahkan Data**

  <img width="443" height="408" alt="image" src="https://github.com/user-attachments/assets/f3a13423-0f54-4757-9d1f-4dbe24e099be" />

* **Menampilkan Data**

  <img width="436" height="585" alt="image" src="https://github.com/user-attachments/assets/c8bb094e-9b74-4974-85d1-2790b35cefac" />

* **Mengubah Data**

  <img width="497" height="437" alt="image" src="https://github.com/user-attachments/assets/8df0aa1f-4621-4818-889b-f3837945f82a" />

  Hasil:

  <img width="441" height="586" alt="image" src="https://github.com/user-attachments/assets/395326c8-903f-436e-bc3a-a4a60de2ea18" />

* **Menghapus Data**

  <img width="438" height="354" alt="image" src="https://github.com/user-attachments/assets/f4605c92-b5c4-43d3-a2c3-2efddbd7089e" />

  Hasil:

  <img width="424" height="454" alt="image" src="https://github.com/user-attachments/assets/121c3c65-e737-4c93-a1c8-fc5196594f66" />

* **Mencari Data**

  <img width="423" height="496" alt="image" src="https://github.com/user-attachments/assets/dbab8567-e568-4017-ac82-3b4502908bc1" />


---

### 3. Python
* **Menambahkan Data**

  <img width="501" height="416" alt="image" src="https://github.com/user-attachments/assets/b4f9cbf9-24bf-44d8-a914-0705c1fee6e8" />

* **Menampilkan Data**

  <img width="428" height="584" alt="image" src="https://github.com/user-attachments/assets/310c5a49-6303-4720-8905-0da6971bb385" />

* **Mengubah Data**

  <img width="466" height="436" alt="image" src="https://github.com/user-attachments/assets/d1e218fb-45a9-4999-85ed-707786022a6d" />

  Hasil:

  <img width="430" height="576" alt="image" src="https://github.com/user-attachments/assets/321768ad-e588-4422-84b3-4e83eb88b58f" />

* **Menghapus Data**
  
  <img width="419" height="344" alt="image" src="https://github.com/user-attachments/assets/f2b4a674-be25-44b1-a56e-3edca3ccb0d0" />

  Hasil:

  <img width="431" height="444" alt="image" src="https://github.com/user-attachments/assets/02b00fed-f8e1-41af-ae85-9be84525f06f" />

* **Mencari Data**

  <img width="434" height="491" alt="image" src="https://github.com/user-attachments/assets/be6c194a-8045-4a4c-9702-8d3cb27ce96b" />


---

### 4. PHP (Web)
* **Error jika menambahkan ID yang sudah dipakai**

  <img width="1428" height="215" alt="image" src="https://github.com/user-attachments/assets/58fc8608-fbda-43f0-b787-723ab24b28fc" />

* **Error jika meng-update ID tapi sudah dipakai**
  
  <img width="1372" height="234" alt="image" src="https://github.com/user-attachments/assets/15677d88-4f2e-4fd6-bd3d-0361526c4c88" />

* **Error jika harga berupa angka minus**
  
  <img width="1364" height="228" alt="image" src="https://github.com/user-attachments/assets/6af66f2b-2bf6-44f7-b323-bbcabb9168ce" />


* **Menambahkan Data**
  
  <img width="1370" height="529" alt="image" src="https://github.com/user-attachments/assets/19301f7f-a321-4a41-b555-a2082a278869" />

  Hasil:

  <img width="1353" height="236" alt="image" src="https://github.com/user-attachments/assets/4bd509f3-565d-4e21-bb0e-f2a4b4566fb8" />

* **Menampilkan Data**

  <img width="1343" height="377" alt="image" src="https://github.com/user-attachments/assets/6b12b483-7118-4e5f-97b9-9c4df33e5a5a" />

* **Mengubah Data**

  <img width="1371" height="512" alt="image" src="https://github.com/user-attachments/assets/3d857fee-8d6a-4389-a822-b6533e9a5d65" />

  Hasil:

  <img width="1363" height="370" alt="image" src="https://github.com/user-attachments/assets/7c6fc3ba-97e6-480a-b27d-78990ee6e2f7" />

* **Menghapus Data**
  Terdapat tombol "Hapus" untuk menghapus data:

  <img width="1363" height="370" alt="image" src="https://github.com/user-attachments/assets/e9980882-5c05-4af5-baa9-f19af0c3d4e0" />

  Menghapus barang 001:

  <img width="1363" height="248" alt="image" src="https://github.com/user-attachments/assets/bdedfe71-b179-4c00-aeae-ff040c09ec07" />

  Tombol "Reset Seluruh Sistem" untuk mereset:

  <img width="1401" height="250" alt="image" src="https://github.com/user-attachments/assets/ae84eb66-17f4-4b97-a33a-0325681d5f36" />

* **Mencari Data**

  <img width="1361" height="101" alt="image" src="https://github.com/user-attachments/assets/182aba1c-efa1-45e7-83fc-626cf9bbdf27" />

  Hasil:

  <img width="1399" height="285" alt="image" src="https://github.com/user-attachments/assets/97c2302d-d0db-4d32-93d6-b28505e3b0b7" />


