#include <vector>
#include <limits>
#include "Film.cpp"

using namespace std;

vector<Film> daftarFilm; // Array dinamis untuk menyimpan data film

// Memeriksa keberadaan ID di sistem
bool isIdExists(const string& id) {
    for (const auto& film : daftarFilm) {
        if (film.getId() == id) {
            return true;
        }
    }
    return false;
}

// Menampilkan interface menu utama
void tampilkanMenu() {
    cout << "\n============================================\n";
    cout << "       SYSTEM MANAGEMENT CINEMA XXI         \n";
    cout << "============================================\n";
    cout << " [1] Tambah Judul Film Baru\n";
    cout << " [2] Lihat Katalog Film\n";
    cout << " [3] Perbarui Data Film\n";
    cout << " [4] Hapus Film dari Katalog\n";
    cout << " [5] Pencarian Spesifik Film\n";
    cout << " [6] Keluar Sistem\n";
    cout << "--------------------------------------------\n";
    cout << "Pilih Opsi [1-6]: ";
}

// Operasi penambahan record data
void tambahData() {
    string id, judul, genre;
    int harga;

    cout << "\n>>> ENTRI DATA FILM BARU <<<\n";

    do {
        cout << "Masukkan ID/Kode Film : ";
        cin >> id;
        if (isIdExists(id)) {
            cout << "[!] Peringatan: Kode ID sudah terdaftar di sistem.\n";
        }
    } while (isIdExists(id));

    cin.ignore(numeric_limits<streamsize>::max(), '\n');

    cout << "Judul Film            : ";
    getline(cin, judul);

    cout << "Kategori / Genre      : ";
    getline(cin, genre);

    while (true) {
        cout << "Harga Tiket (Rp)      : ";
        cin >> harga;
        if (cin.fail() || harga <= 0) {
            cout << "[!] Input tidak valid. Masukkan besaran angka positif.\n";
            cin.clear();
            cin.ignore(numeric_limits<streamsize>::max(), '\n');
        } else {
            cin.ignore(numeric_limits<streamsize>::max(), '\n');
            break;
        }
    }

    daftarFilm.push_back(Film(id, judul, genre, harga));
    cout << "STATUS: Data film berhasil disimpan ke katalog!\n";
}

// Menampilkan katalog data dengan format terstruktur
void tampilkanData() {
    cout << "\n>>> KATALOG FILM TERSEDIA <<<\n";
    if (daftarFilm.empty()) {
        cout << "[!] Belum ada data film yang tersimpan.\n";
        return;
    }
    
    int nomor = 1;
    for (const auto& film : daftarFilm) {
        cout << "--------------------------------------------\n";
        cout << "Film #" << nomor++ << "\n";
        cout << "  - ID/Kode  : " << film.getId() << "\n";
        cout << "  - Judul    : " << film.getJudul() << "\n";
        cout << "  - Genre    : " << film.getGenre() << "\n";
        cout << "  - HTM      : Rp " << film.getHarga() << "\n";
    }
    cout << "--------------------------------------------\n";
}

// Operasi pembaruan record
void updateData() {
    string id_update;
    cout << "\n>>> PERBARUI DATA FILM <<<\n";
    cout << "Masukkan ID Film Sasaran: ";
    cin >> id_update;
    cin.ignore(numeric_limits<streamsize>::max(), '\n');

    for (auto& film : daftarFilm) {
        if (film.getId() == id_update) {
            string id_baru;
            cout << "Ganti ID [" << film.getId() << "] menjadi (Tekan ENTER jika tetap): ";
            getline(cin, id_baru);
            if (!id_baru.empty()) {
                if (id_baru != film.getId() && isIdExists(id_baru)) {
                    cout << "[!] ID baru sudah terpakai. Perubahan ID dibatalkan.\n";
                } else {
                    film.setId(id_baru);
                }
            }

            string judul_baru;
            cout << "Ganti Judul [" << film.getJudul() << "] menjadi: ";
            getline(cin, judul_baru);
            if (!judul_baru.empty()) {
                film.setJudul(judul_baru);
            }

            string genre_baru;
            cout << "Ganti Genre [" << film.getGenre() << "] menjadi: ";
            getline(cin, genre_baru);
            if (!genre_baru.empty()) {
                film.setGenre(genre_baru);
            }

            string harga_baru;
            cout << "Ganti HTM [" << film.getHarga() << "] menjadi: ";
            getline(cin, harga_baru);
            if (!harga_baru.empty()) {
                film.setHarga(stoi(harga_baru));
            }

            cout << "STATUS: Informasi film berhasil diperbarui!\n";
            return;
        }
    }
    cout << "[!] Error: Film dengan ID '" << id_update << "' tidak ditemukan.\n";
}

// Operasi penghapusan record
void hapusData() {
    string id_hapus;
    cout << "\n>>> HAPUS FILM DARI KATALOG <<<\n";
    cout << "Masukkan ID Film yang akan dihapus: ";
    cin >> id_hapus;

    for (auto it = daftarFilm.begin(); it != daftarFilm.end(); ++it) {
        if (it->getId() == id_hapus) {
            daftarFilm.erase(it);
            cout << "STATUS: Film berhasil dihapus dari sistem!\n";
            return;
        }
    }
    cout << "[!] Error: Film dengan ID '" << id_hapus << "' tidak ditemukan.\n";
}

// Operasi pencarian record
void cariData() {
    string id_cari;
    bool found = false;
    cout << "\n>>> PENCARIAN DATA FILM <<<\n";
    cout << "Masukkan ID Film yang dicari: ";
    cin >> id_cari;

    for (const auto& film : daftarFilm) {
        if (film.getId() == id_cari) {
            cout << "\n[RESULT] Data Film Ditemukan:\n";
            cout << "============================================\n";
            cout << " Kode Film : " << film.getId() << "\n";
            cout << " Judul     : " << film.getJudul() << "\n";
            cout << " Genre     : " << film.getGenre() << "\n";
            cout << " Harga     : Rp " << film.getHarga() << "\n";
            cout << "============================================\n";
            found = true;
            return;
        }
    }
    
    if (!found) {
        cout << "[!] Maaf, data film tidak ditemukan.\n";
    }
}

int main() {
    int pilihan;

    do {
        tampilkanMenu();
        cin >> pilihan;

        if (cin.fail()) {
            cin.clear();
            cin.ignore(numeric_limits<streamsize>::max(), '\n');
            pilihan = 0;
        }

        switch (pilihan) {
            case 1: tambahData(); break;
            case 2: tampilkanData(); break;
            case 3: updateData(); break;
            case 4: hapusData(); break;
            case 5: cariData(); break;
            case 6: cout << "\nSistem dimatikan. Terima kasih!\n"; break;
            default: cout << "[!] Pilihan menu tidak valid, silakan coba lagi.\n";
        }
    } while (pilihan != 6);

    return 0;
}