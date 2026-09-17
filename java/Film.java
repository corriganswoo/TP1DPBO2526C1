// Class Film untuk merepresentasikan data film di bioskop
public class Film {
    // Atribut privat (Encapsulation)
    private String id;
    private String judul;
    private String genre;
    private int harga;

    // Constructor Kosong
    public Film() {

    }

    // Constructor Berparameter untuk inisialisasi atribut
    public Film(String id, String judul, String genre, int harga) {
        this.id = id;
        this.judul = judul;
        this.genre = genre;
        this.harga = harga;
    }

    // Getter
    public String getId() { 
        return id; 
    }
    public String getJudul() { 
        return judul; 
    }
    public String getGenre() { 
        return genre; 
    }
    public int getHarga() { 
        return harga; 
    }

    // Setter
    public void setId(String id) { 
        this.id = id; 
    }
    public void setJudul(String judul) { 
        this.judul = judul; 
    }
    public void setGenre(String genre) { 
        this.genre = genre; 
    }
    public void setHarga(int harga) { 
        this.harga = harga; 
    }
}