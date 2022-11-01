const Usuario = document.getElementById('Usuario')
const Contraseña = document.getElementById('Contraseña')
const Boton = document.getElementById('Boton')

Boton.addEventListener('click', (e) => {
    e.preventDefault()
    const data = {
        Usuario: Usuario.value,
        Contraseña: Contraseña.value
    }

    console.log(data)
})