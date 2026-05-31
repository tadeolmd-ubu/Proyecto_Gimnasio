-- Migración: Agregar columna id_Entrenador a Membresia
ALTER TABLE Membresia ADD COLUMN id_Entrenador INT NULL AFTER id_Tipo_Membresia;
ALTER TABLE Membresia ADD CONSTRAINT fk_membresia_entrenador FOREIGN KEY (id_Entrenador) REFERENCES Entrenador(id_Entrenador);
