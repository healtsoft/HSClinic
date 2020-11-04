<template>
    <input
        type="submit"
        class="btn btn-danger" 
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
                    title: '¿Deseas eliminar este Paciente?',
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
                    axios.post(`/paciente/delete/${this.servicioId}`, {params, _method: 'delete'})
                        .then(respuesta => {
                            this.$swal({
                                title: 'Paciente Eliminado',
                                text: 'Se elimino el Paciente',
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

