<template>
    <div>
        <div class="popup" v-if="hasUpdate">
            <p class="title">Статья {{ title }} была изменена</p>
            <p>Были изменены поля:</p>
            <p v-for="field in fields">
                {{ field }}
            </p>
            <a class="link" :href="'/admin/articles/' + code">Ссылка на статью</a>
            <button @click.prevent="close()" class="btn btn-danger">
                Закрыть
            </button>
        </div>
    </div>
</template>

<style>
.popup {
    display: block;
    position: fixed;
    bottom: 15px;
    right: 15px;
    width: 300px;
    height: 230px;
    padding: 10px;
    background-color: #ffffff;
    border: 3px solid #f1f1f1;
    z-index: 10;
}

.title {
    font-size: 18px;
    margin-bottom: 5px;
    color: blue;
}

.link {
    display:block;
    color: red;
}

.btn {

}
</style>

<script>
export default {
    data() {
        return {
            hasUpdate: false,
            title: "",
            code: "",
            fields: [],
        };
    },

    mounted() {
        Echo.private("admin").listen(".article.update", (e) => {
            console.log(e.fields);
            for (var key in e.fields) {
                if (e.fields.hasOwnProperty(key) && key !== 'updated_at') {
                    this.fields.push(key)
                }
            }
            this.hasUpdate = true;
            this.title = e.article.title;
            this.code = e.article.code;
        });
    },

    methods: {
        close() {
            this.hasUpdate = false;
        },
    },
};
</script>
