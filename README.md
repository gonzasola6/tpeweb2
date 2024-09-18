# Disqueria

# Trabajo practico especial

## Integrantes:
    * Gonzalo Sola
    * Ariadna Cataldi

## Descripción:

Diseñamos una base de datos que almacena un conjunto de elementos, que interaccionan entre sí. 
El diseño se basa en diferentes discos con sus datos, que se relacionan directamente con los autores y sus respectivos datos.

Posee dos tablas:
PRIMER TABLA: Álbumes (ID_Album, nombre, lanzamiento, cantCanciones, genero, ID_Autor [clave foránea]). 
SEGUNDA TABLA: Autores (ID_Autor, nombre, pais, cantAlbumes).

La clave foránea es ID_Autor en la tabla de álbumes, y la clave referenciada es ID_Autor en Autores.

Mediante los ID se puede relacionar los albumes con sus respectivos autores y poder encontrar sus atributos.

Las tablas tiene una relacion 1 a N (N=Álbumes), es decir, un autor puede relacionarse a muchos álbumes (o ninguno), y un álbum relacionarse a un solo autor.





## DER

![Diagrama Entidad Relación](/der.png)
