
# API de Biblioteca

Esta API proporciona servicios RESTful para la gestión de una biblioteca. Permite consultar, agregar, modificar y eliminar autores, así como gestionar tokens de autenticación.

---
# Integrantes
 Geronimo Oliveto
## **Endpoints principales**

### **Autores**

#### **1. Obtener todos los autores**
- **GET** `http://localhost/tpe-especialApi/api/autores`
  
  **Parámetros opcionales**:
  - `bio` (1): Filtra autores con biografía disponible.
  - `filtrarNombre`: Filtra autores cuyo nombre coincida parcialmente.
  - `orderBy`: Ordena los autores por un campo específico (`nombre` o `libros`).
  - `asc` (1/0): Define el orden ascendente (1) o descendente (0).  
  - `pagina`: Número de la página (para paginación).
  - `resultados`: Cantidad de resultados por página.

  **Ejemplo de uso**:
  ```bash
  curl "http://localhost/tpe-especialApi/api/autores?bio=1&orderBy=nombre&asc=1&pagina=1&resultados=5"
  ```

#### **2. Obtener un autor por ID**
- **GET** `http://localhost/tpe-especialApi/api/autores/:id`

  Devuelve los datos del autor con el ID especificado.  
  **Ejemplo de uso**:
  ```bash
  curl "http://localhost/tpe-especialApi/api/autores/1"
  ```

#### **3. Agregar un nuevo autor**
- **POST** `http://localhost/tpe-especialApi/api/autores`  
  _Requiere autorización_.

  **Body** (JSON):
  ```json
  {
    "nombre_autor": "Gabriel García Márquez",
    "nacionalidad_autor": "Colombiana",
    "biografia_autor": "Autor de 'Cien años de soledad'"
  }
  ```

  **Ejemplo de uso**:
  ```bash
  curl -X POST "http://localhost/tpe-especialApi/api/autores"   -H "Authorization: Bearer <TOKEN>"   -H "Content-Type: application/json"   -d '{
    "nombre_autor": "Gabriel García Márquez",
    "nacionalidad_autor": "Colombiana",
    "biografia_autor": "Autor de 'Cien años de soledad'"
  }'
  ```

#### **4. Editar un autor**
- **PUT** `http://localhost/tpe-especialApi/api/autores/:id`  
  _Requiere autorización_.

  **Body** (JSON):
  ```json
  {
    "nombre_autor": "Gabriel García Márquez",
    "nacionalidad_autor": "Colombiana"
  }
  ```

  **Ejemplo de uso**:
  ```bash
  curl -X PUT "http://localhost/tpe-especialApi/api/autores/1"   -H "Authorization: Bearer <TOKEN>"   -H "Content-Type: application/json"   -d '{
    "nombre_autor": "Gabriel García Márquez",
    "nacionalidad_autor": "Colombiana"
  }'
  ```

#### **5. Eliminar un autor**
- **DELETE** `http://localhost/tpe-especialApi/api/autores/:id`  
  _Requiere autorización_.

  **Ejemplo de uso**:
  ```bash
  curl -X DELETE "http://localhost/tpe-especialApi/api/autores/1"   -H "Authorization: Bearer <TOKEN>"
  ```

---

### **Generar Token de Autenticación**

#### **1. Obtener un token**
- **GET** `http://localhost/tpe-especialApi/api/usuarios/token`  
  _Usuario: webadmin \ Contraseña: admin._

  **Encabezado requerido**:
  - `Authorization: Basic <credenciales_base64>`  
    (Las credenciales deben estar en formato `usuario:contraseña` codificado en Base64).

  **Ejemplo de uso**:
  ```bash
  curl -X GET "http://localhost/tpe-especialApi/api/usuarios/token"   -H "Authorization: Basic d2ViYWRtaW46YWRtaW4="
  ```

  **Respuesta exitosa**:
  ```json
  {
    "token": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxIiwiaWF0IjoxNjY3MzUyODAwLCJleHAiOjE2NjczNTI4NjB9.8sKz7FYY6xY7cY9sHUYzOaGLOiYiHlzKeVkWyGfakQI"
  }
  ```

---

## **Características clave**
- **Autenticación segura**:
  - Verificación de contraseñas utilizando `password_verify`.
  - Emisión de tokens JWT con tiempo de vida configurado (60 segundos por defecto, ajustable).
- **Filtros avanzados**:
  - Filtrado por biografía, nombre, y paginación para eficiencia en grandes conjuntos de datos.
- **Autorización**:
  - Acceso restringido para operaciones de escritura (POST, PUT, DELETE).

---

## **Instalación**

1. Clona este repositorio:
   ```bash
   git clone <URL-del-repositorio>
   cd <carpeta-del-repositorio>
   ```

2. Configura el archivo `config.php` para conectarte a tu base de datos.

3. Importa la base de datos desde el archivo `database.sql` proporcionado.

4. Asegúrate de que tu servidor web esté configurado correctamente para interpretar PHP.
