<template>
    <input
        type="submit"
        class="btn btn-danger d-block w-100 mb-2" 
        value="Eliminar"
        v-on:click="eliminarServicio"
    > 
</template>

<script>
    export default {
        props: ['servicioId'],
        methods: {
            eliminarServicio(){
                this.$swal({
                    title: '¿Deseas eliminar este Usuario?',
                    text: "Una vez eliminado, no se podra recuperar",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si',
                    cancelButtonText: 'No'
                }).then((result) => {
                if (result.isConfirmed) {
                    const params = {
                        id: this.servicioId
                    }

                    //Enviar peticion al servidor
                    axios.post(`/admin/user/${this.servicioId}`, {params, _method: 'delete'})
                        .then(respuesta => {
                            this.$swal({
                                title: 'Usuario Eliminado',
                                text: 'Se elimino el Usuario',
                                icon: 'success'
                            });

                            //eliminar servicio del DOM
                            this.$el.parentNode.parentNode.parentNode.removeChild(this.$el.parentNode.parentNode);
                        })
                        .catch(error => {
                            console.log(error);
                        })

                
                    
                }
                })
            }
        }
    }
</script>

