# Comandos de GIT (Iniciales)
## Requerimientos
- Descargar GIT (https://git-scm.com/)
- Crear una cuenta en GITHUB (https://github.com)
## Configurar GIT 
- ejecutar los siguientes comandos
```
git config --global user.name "Su Nombre"
git config --global user.email "su.correo@mail.com"
```
## Comandos inciales
## Crear un repositorio en GITHUB
## Inicializar un repositorio Local
```
git init
```
### Referencia del respositorio (Local) al repositorio (remoto)
```
git remote add origin https://github.com/cchura94/backend_laravel_vue_proyecto.git
```
## Actualizar el Repositorio
```
git add .
git commit -m "Proyecto Base (CRUD Usuarios)"
git push origin master
```

## obtener los nuevos cambios
```
git pull origin master
``` 