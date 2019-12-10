<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                Blogs
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Blogs mounted.');
            this.fetchBlogs();
        },
        data() {
            return {
                blogs: [],
                blog: {
                    id: '',
                    place: '',
                    comments: '',
                }
            }
        },
        created() {
            this.fetchBlogs();
        },
        methods: {
            fetchBlogs() {
                fetch('api/entry')
                    .then(res => res.json())
                    .then(res => {
                        console.dir(res);
                    })
            }
        }
    }
</script>
