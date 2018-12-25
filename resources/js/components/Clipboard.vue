<template>
    <div>
        <div class="read-status pb-4">
            <strong>{{ this.readStatusText }}</strong>
        </div>
        <div class="row">
            <div class="col-md-9">
                <label>Notatki</label>
                <textarea class="form-control" cols="3"  placeholder="np.: Albert zgubił się w lesie. Żona Alberta jest smutna." v-model="updateNotes"></textarea>
            </div>
            <div class="col-md-3">
                <button class="btn btn-outline-primary button-submit-style" @click="saveNotes()">Zapisz notatki</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-9 mt-2">
                <label>Zakładka</label>
                <input type="text" class="form-control" placeholder="np.: numer strony" v-model="updateBookmark"/>
            </div>
            <div class="col-md-3">
                <button class="btn btn-outline-primary button-submit-style" @click="saveBookmark()">Zapisz zakładkę</button>
            </div>
        </div>
        <div class="bottom-buttons mt-5 text-right">
            <button class="btn btn-primary" @click="saveAsRead()" v-if="this.status == 3">Oznacz jako przeczytaną</button>
            <button class="btn btn-primary" @click="saveAsUnRead()" v-if="this.status == 2">Oznacz jako nieprzeczytaną</button>
            <button class="btn btn-primary" @click="deleteFromBookmark()">Usuń ze schowka</button>
        </div>
        <notifications group="foo" position="bottom right" width="500"/>
    </div>
</template>

<script>
    export default {
        props: ['item', 'notes', 'bookmark', 'status'],
        data () {
            return {
                updateNotes: this.notes,
                updateBookmark: this.bookmark,
                readStatus: this.status,
            }
        },
        computed: {
            readStatusText: function() {
                if(this.status == 2) return 'Przeczytana';
                if(this.status == 3) return 'Nieprzeczytana';
            }
        },
        methods: {
            saveNotes: function() {
                axios.post('/api/saveNotes', {
                    notes: this.updateNotes,
                    item_id: this.item, 
                }).then((response) => {
                    this.$notify({
                        group: 'foo',
                        title: 'Pomyślnie zapisano notatkę.',
                        duration: 1000,
                        type: 'success',
                    });
                }).catch(function (error) {
                    this.$notify({
                        group: 'foo',
                        title: 'Wystąpił błąd podczas zapisywania notatek.',
                        duration: 1000,
                        type: 'error',
                    });
                });
            },
            saveBookmark: function() {
                axios.post('/api/saveBookmark', {
                    bookmark: this.updateBookmark,
                    item_id: this.item, 
                }).then((response) => {
                    this.$notify({
                        group: 'foo',
                        title: 'Pomyślnie zapisano zakładkę.',
                        duration: 1000,
                        type: 'success',
                    });
                }).catch(function (error) {
                    this.$notify({
                        group: 'foo',
                        title: 'Wystąpił błąd podczas zapisywania zkaładki.',
                        duration: 1000,
                        type: 'error',
                    });
                });
            },
            saveAsRead: function() {
                axios.post('/api/saveAsRead', {
                    item_id: this.item,
                }).then((response) => {
                    this.$notify({
                        group: 'foo',
                        title: 'Pomyślnie zmieniono status ksiązki na przeczytaną.',
                        duration: 1000,
                        type: 'success',
                    });
                }).catch(function (error) {
                    this.$notify({
                        group: 'foo',
                        title: 'Wystąpił błąd podczas zmiany statusu.',
                        duration: 1000,
                        type: 'error',
                    });
                });
            },
            saveAsUnRead: function() {
                axios.post('/api/saveAsUnRead', {
                    item_id: this.item,
                }).then((response) => {
                    this.$notify({
                        group: 'foo',
                        title: 'Pomyślnie zmieniono status ksiązki na nieprzeczytaną.',
                        duration: 1000,
                        type: 'success',
                    });
                }).catch(function (error) {
                    this.$notify({
                        group: 'foo',
                        title: 'Wystąpił błąd podczas zmiany statusu.',
                        duration: 1000,
                        type: 'error',
                    });
                });
            },
            deleteFromBookmark: function() {
                axios.post('/api/deleteFromBookmark', {
                    item_id: this.item,
                }).then((response) => {
                    this.$notify({
                        group: 'foo',
                        title: 'Pomyślnie usunięto książkę ze schowka.',
                        duration: 1000,
                        type: 'success',
                    });
                    location.reload();
                }).catch(function (error) {
                    this.$notify({
                        group: 'foo',
                        title: 'Wystąpił błąd podczas usuwania książki ze schowka.',
                        duration: 1000,
                        type: 'error',
                    });
                });
            },
        }
    }
</script>

<style>
    .button-submit-style {
        margin-top: 38px;
    }
</style>
