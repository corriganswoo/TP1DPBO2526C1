from Film import Film

# List dinamis untuk menyimpan daftar film
daftar_film = []

# Memeriksa keberadaan ID di sistem
def is_id_exists(id_film):
    for film in daftar_film:
        if film.get_id() == id_film:
            return True
    return False

# Menampilkan interface menu utama
def tampilkan_menu():
    print("\n============================================")
    print("       SYSTEM MANAGEMENT CINEMA XXI         ")
    print("============================================")
    print(" [1] Tambah Judul Film Baru")
    print(" [2] Lihat Katalog Film")
    print(" [3] Perbarui Data Film")
    print(" [4] Hapus Film dari Katalog")
    print(" [5] Pencarian Spesifik Film")
    print(" [6] Keluar Sistem")
    print("--------------------------------------------")

# Operasi penambahan record data
def tambah_data():
    print("\n>>> ENTRI DATA FILM BARU <<<")

    while True:
        id_film = input("Masukkan ID/Kode Film : ").strip()
        if is_id_exists(id_film):
            print("[!] Peringatan: Kode ID sudah terdaftar di sistem.")
        else:
            break

    judul = input("Judul Film            : ").strip()
    genre = input("Kategori / Genre      : ").strip()

    while True:
        try:
            harga = int(input("Harga Tiket (Rp)      : "))
            if harga <= 0:
                print("[!] Input tidak valid. Masukkan besaran angka positif.")
            else:
                break
        except ValueError:
            print("[!] Input tidak valid. Masukkan besaran angka positif.")

    daftar_film.append(Film(id_film, judul, genre, harga))
    print("STATUS: Data film berhasil disimpan ke katalog!")

# Menampilkan katalog data dengan format terstruktur
def tampilkan_data():
    print("\n>>> KATALOG FILM TERSEDIA <<<")
    if not daftar_film:
        print("[!] Belum ada data film yang tersimpan.")
        return

    for nomor, film in enumerate(daftar_film, start=1):
        print("--------------------------------------------")
        print(f"Film #{nomor}")
        print(f"  - ID/Kode  : {film.get_id()}")
        print(f"  - Judul    : {film.get_judul()}")
        print(f"  - Genre    : {film.get_genre()}")
        print(f"  - HTM      : Rp {film.get_harga()}")
    print("--------------------------------------------")

# Operasi pembaruan record
def update_data():
    print("\n>>> PERBARUI DATA FILM <<<")
    id_update = input("Masukkan ID Film Sasaran: ").strip()

    for film in daftar_film:
        if film.get_id() == id_update:
            id_baru = input(f"Ganti ID [{film.get_id()}] menjadi (Tekan ENTER jika tetap): ").strip()
            if id_baru:
                if id_baru != film.get_id() and is_id_exists(id_baru):
                    print("[!] ID baru sudah terpakai. Perubahan ID dibatalkan.")
                else:
                    film.set_id(id_baru)

            judul_baru = input(f"Ganti Judul [{film.get_judul()}] menjadi: ").strip()
            if judul_baru:
                film.set_judul(judul_baru)

            genre_baru = input(f"Ganti Genre [{film.get_genre()}] menjadi: ").strip()
            if genre_baru:
                film.set_genre(genre_baru)

            harga_baru = input(f"Ganti HTM [{film.get_harga()}] menjadi: ").strip()
            if harga_baru:
                try:
                    film.set_harga(int(harga_baru))
                except ValueError:
                    print("[!] Input harga tidak valid, harga tidak diubah.")

            print("STATUS: Informasi film berhasil diperbarui!")
            return

    print(f"[!] Error: Film dengan ID '{id_update}' tidak ditemukan.")

# Operasi penghapusan record
def hapus_data():
    print("\n>>> HAPUS FILM DARI KATALOG <<<")
    id_hapus = input("Masukkan ID Film yang akan dihapus: ").strip()

    for i, film in enumerate(daftar_film):
        if film.get_id() == id_hapus:
            daftar_film.pop(i)
            print("STATUS: Film berhasil dihapus dari sistem!")
            return

    print(f"[!] Error: Film dengan ID '{id_hapus}' tidak ditemukan.")

# Operasi pencarian record
def cari_data():
    print("\n>>> PENCARIAN DATA FILM <<<")
    id_cari = input("Masukkan ID Film yang dicari: ").strip()

    for film in daftar_film:
        if film.get_id() == id_cari:
            print("\n[RESULT] Data Film Ditemukan:")
            print("============================================")
            print(f" Kode Film : {film.get_id()}")
            print(f" Judul     : {film.get_judul()}")
            print(f" Genre     : {film.get_genre()}")
            print(f" Harga     : Rp {film.get_harga()}")
            print("============================================")
            return

    print("[!] Maaf, data film tidak ditemukan.")

# Main Program Execution Loop
def main():
    pilihan = 0
    while pilihan != 6:
        tampilkan_menu()
        try:
            pilihan = int(input("Pilih Opsi [1-6]: "))
        except ValueError:
            pilihan = 0

        if pilihan == 1:
            tambah_data()
        elif pilihan == 2:
            tampilkan_data()
        elif pilihan == 3:
            update_data()
        elif pilihan == 4:
            hapus_data()
        elif pilihan == 5:
            cari_data()
        elif pilihan == 6:
            print("\nSistem dimatikan. Terima kasih!")
        else:
            print("[!] Pilihan menu tidak valid, silakan coba lagi.")

if __name__ == "__main__":
    main()