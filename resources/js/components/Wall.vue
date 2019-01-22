<template>
    <div>
        <div class="jumbotron">
            <p class="lead">Dodaj post</p>
            <textarea class="form-control" cols="2" placeholder="Jaką książkę przeczytałeś/aś ostatnio?" v-model="content"></textarea>
            <p class="text-right">
                <select class="button-submit-style" v-model="status">
                    <option value="1">Publiczne</option>
                    <option value="2">Prywatne</option>
                </select>
                <button class="btn btn-primary btn-lg" @click="publishPost()">Opublikuj</button>
            </p>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['user'],
        data () {
            return {
                content: '',
                status: 1,
            }
        },
        computed: {
            //
        },
        methods: {
            publishPost: function() {;
                axios.post('/api/publishPost', {
                    user_id: this.user.user_id,
                    content: this.content,
                    status: this.status,
                }).then((response) => {
                    this.content = '';
                    this.$notify({
                        group: 'foo',
                        title: 'Pomyślnie dodano post. Odśwież stronę aby go zobaczyć.',
                        duration: 1500,
                        type: 'success',
                    });
                }).catch(function (error) {
                    this.$notify({
                        group: 'foo',
                        title: 'Wystąpił błąd podczas dodawania postu.',
                        duration: 1500,
                        type: 'error',
                    });
                });
            }
        }
    };
</script>

<style>
    .button-submit-style {
        margin-top: 38px;
    }
</style>
