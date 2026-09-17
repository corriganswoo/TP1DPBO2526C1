import java.util.ArrayList;
import java.util.Scanner;

public class Main {
    // ArrayList dinamis untuk menyimpan daftar film
    private static ArrayList<Film> daftarFilm = new ArrayList<>();
    private static Scanner scanner = new Scanner(System.in);

    // Memeriksa keberadaan ID di sistem
    public static boolean isIdExists(String id) {
        for (Film film : daftarFilm) {
            if (film.getId().equals(id)) {
                return true;
            }
        }
        return false;
    }

    // Menampilkan interface menu utama
    public static void tampilkanMenu() {
        System.out.println("\n============================================");
        System.out.println("       SYSTEM MANAGEMENT CINEMA XXI         ");
        System.out.println("============================================");
        System.out.println(" [1] Tambah Judul Film Baru");
        System.out.println(" [2] Lihat Katalog Film");
        System.out.println(" [3] Perbarui Data Film");
        System.out.println(" [4] Hapus Film dari Katalog");
        System.out.println(" [5] Pencarian Spesifik Film");
        System.out.println(" [6] Keluar Sistem");
        System.out.println("--------------------------------------------");
        System.out.print("Pilih Opsi [1-6]: ");
    }

    // Operasi penambahan record data
    public static void tambahData() {
        String id, judul, genre;
        int harga = 0;

        System.out.println("\n>>> ENTRI DATA FILM BARU <<<");

        do {
            System.out.print("Masukkan ID/Kode Film : ");
            id = scanner.nextLine();
            if (isIdExists(id)) {
                System.out.println("[!] Peringatan: Kode ID sudah terdaftar di sistem.");
            }
        } while (isIdExists(id));

        System.out.print("Judul Film            : ");
        judul = scanner.nextLine();

        System.out.print("Kategori / Genre      : ");
        genre = scanner.nextLine();

        while (true) {
            System.out.print("Harga Tiket (Rp)      : ");
            try {
                harga = Integer.parseInt(scanner.nextLine());
                if (harga <= 0) {
                    System.out.println("[!] Input tidak valid. Masukkan besaran angka positif.");
                } else {
                    break;
                }
            } catch (NumberFormatException e) {
                System.out.println("[!] Input tidak valid. Masukkan besaran angka positif.");
            }
        }

        daftarFilm.add(new Film(id, judul, genre, harga));
        System.out.println("STATUS: Data film berhasil disimpan ke katalog!");
    }

    // Menampilkan katalog data dengan format terstruktur
    public static void tampilkanData() {
        System.out.println("\n>>> KATALOG FILM TERSEDIA <<<");
        if (daftarFilm.isEmpty()) {
            System.out.println("[!] Belum ada data film yang tersimpan.");
            return;
        }

        int nomor = 1;
        for (Film film : daftarFilm) {
            System.out.println("--------------------------------------------");
            System.out.println("Film #" + (nomor++));
            System.out.println("  - ID/Kode  : " + film.getId());
            System.out.println("  - Judul    : " + film.getJudul());
            System.out.println("  - Genre    : " + film.getGenre());
            System.out.println("  - HTM      : Rp " + film.getHarga());
        }
        System.out.println("--------------------------------------------");
    }

    // Operasi pembaruan record
    public static void updateData() {
        System.out.println("\n>>> PERBARUI DATA FILM <<<");
        System.out.print("Masukkan ID Film Sasaran: ");
        String id_update = scanner.nextLine();

        for (Film film : daftarFilm) {
            if (film.getId().equals(id_update)) {
                System.out.print("Ganti ID [" + film.getId() + "] menjadi (Tekan ENTER jika tetap): ");
                String id_baru = scanner.nextLine();
                if (!id_baru.isEmpty()) {
                    if (!id_baru.equals(film.getId()) && isIdExists(id_baru)) {
                        System.out.println("[!] ID baru sudah terpakai. Perubahan ID dibatalkan.");
                    } else {
                        film.setId(id_baru);
                    }
                }

                System.out.print("Ganti Judul [" + film.getJudul() + "] menjadi: ");
                String judul_baru = scanner.nextLine();
                if (!judul_baru.isEmpty()) {
                    film.setJudul(judul_baru);
                }

                System.out.print("Ganti Genre [" + film.getGenre() + "] menjadi: ");
                String genre_baru = scanner.nextLine();
                if (!genre_baru.isEmpty()) {
                    film.setGenre(genre_baru);
                }

                System.out.print("Ganti HTM [" + film.getHarga() + "] menjadi: ");
                String harga_baru = scanner.nextLine();
                if (!harga_baru.isEmpty()) {
                    try {
                        film.setHarga(Integer.parseInt(harga_baru));
                    } catch (NumberFormatException e) {
                        System.out.println("[!] Input harga tidak valid, harga tidak diubah.");
                    }
                }

                System.out.println("STATUS: Informasi film berhasil diperbarui!");
                return;
            }
        }
        System.out.println("[!] Error: Film dengan ID '" + id_update + "' tidak ditemukan.");
    }

    // Operasi penghapusan record
    public static void hapusData() {
        System.out.println("\n>>> HAPUS FILM DARI KATALOG <<<");
        System.out.print("Masukkan ID Film yang akan dihapus: ");
        String id_hapus = scanner.nextLine();

        for (int i = 0; i < daftarFilm.size(); i++) {
            if (daftarFilm.get(i).getId().equals(id_hapus)) {
                daftarFilm.remove(i);
                System.out.println("STATUS: Film berhasil dihapus dari sistem!");
                return;
            }
        }
        System.out.println("[!] Error: Film dengan ID '" + id_hapus + "' tidak ditemukan.");
    }

    // Operasi pencarian record
    public static void cariData() {
        System.out.println("\n>>> PENCARIAN DATA FILM <<<");
        System.out.print("Masukkan ID Film yang dicari: ");
        String id_cari = scanner.nextLine();

        for (Film film : daftarFilm) {
            if (film.getId().equals(id_cari)) {
                System.out.println("\n[RESULT] Data Film Ditemukan:");
                System.out.println("============================================");
                System.out.println(" Kode Film : " + film.getId());
                System.out.println(" Judul     : " + film.getJudul());
                System.out.println(" Genre     : " + film.getGenre());
                System.out.println(" Harga     : Rp " + film.getHarga());
                System.out.println("============================================");
                return;
            }
        }
        System.out.println("[!] Maaf, data film tidak ditemukan.");
    }

    public static void main(String[] args) {
        int pilihan = 0;

        do {
            tampilkanMenu();
            try {
                pilihan = Integer.parseInt(scanner.nextLine());
            } catch (NumberFormatException e) {
                pilihan = 0;
            }

            switch (pilihan) {
                case 1: tambahData(); break;
                case 2: tampilkanData(); break;
                case 3: updateData(); break;
                case 4: hapusData(); break;
                case 5: cariData(); break;
                case 6: System.out.println("\nSistem dimatikan. Terima kasih!"); break;
                default: System.out.println("[!] Pilihan menu tidak valid, silakan coba lagi.");
            }
        } while (pilihan != 6);
    }
}