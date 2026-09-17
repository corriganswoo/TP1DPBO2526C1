#include <iostream>
#include <string>

using namespace std;

// Class Film
class Film {
private:
    string id;
    string judul;
    string genre;
    int harga;

public:
    Film() {}

    Film(string id, string judul, string genre, int harga) {
        this->id = id;
        this->judul = judul;
        this->genre = genre;
        this->harga = harga;
    }

    ~Film() {} // Destruktor

    // Getter
    string getId() const { return id; }
    string getJudul() const { return judul; }
    string getGenre() const { return genre; }
    int getHarga() const { return harga; }

    // Setter
    void setId(string id) { this->id = id; }
    void setJudul(string judul) { this->judul = judul; }
    void setGenre(string genre) { this->genre = genre; }
    void setHarga(int harga) { this->harga = harga; }
};