<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h2>Blogs</h2>

                <form @submit.prevent="createBlog">
                    <input type="text" v-model="blog.place">
                    <textarea v-model="blog.comments"></textarea>
                    <button type="submit">Create</button>
                </form>

                <div v-for="blog in blogs" v-bind:key="blog.id">
                    <h3>{{ blog.place }}</h3>
                    <p>{{ blog.comments }}</p>

                    <button @click="updateBlog(blog.id)">Update</button>
                    <button @click="deleteBlog(blog.id)">Delete</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Blogs mounted.');
        },
        created() {
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
        methods: {
            fetchBlogs() {
                fetch('api/entry')
                    .then(res => res.json())
                    .then(res => {
                        this.blogs = res;
                    })
            },
            updateBlog(id) {

            },
            deleteBlog(id) {
                if (confirm('Are you sure?')) {
                    fetch('api/entry/${id}', {
                        method: 'delete'
                    })
                    .then(res => res.json())
                    .then(res => {
                        alert('Blog removed');
                        this.fetchBlogs();
                    });
                }
            },
            createBlog() {
                if (this.edit === false)
                {
                    fetch('api/entry', {
                        method: 'post',
                        body: JSON.stringify(this.blog),
                        headers: {
                            'content-type' : 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(res => {
                        this.blog.place = '';
                        this.blog.comments = '';
                        alert('Blog created');
                        this.fetchBlogs();
                    });
                }
            }
        }
    }
</script>
