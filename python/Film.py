# Class Film untuk merepresentasikan data film di bioskop
class Film:
    # Constructor dengan atribut private (Encapsulation menggunakan double underscore __)
    def __init__(self, id_film="", judul="", genre="", harga=0):
        self.__id = id_film
        self.__judul = judul
        self.__genre = genre
        self.__harga = harga

    # Getter
    def get_id(self):
        return self.__id

    def get_judul(self):
        return self.__judul

    def get_genre(self):
        return self.__genre

    def get_harga(self):
        return self.__harga

    # Setter
    def set_id(self, id_film):
        self.__id = id_film

    def set_judul(self, judul):
        self.__judul = judul

    def set_genre(self, genre):
        self.__genre = genre

    def set_harga(self, harga):
        self.__harga = harga