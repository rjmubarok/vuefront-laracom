<template>
    <div class="card card-body">
        <h4>Category</h4>
        <ul :class="{ loading }">
            <li v-for="category in categories">
                {{ category.name }}
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    data: function () {
        return {
            loading: true,
            categories: [],
        };
    },

    mounted() {
        this.loadCategories();
    },

    methods: {
        loadCategories: function () {
            axios
                .get("/api/category")
                .then((response) => {
                    this.categories = response.data;
                    this.loading = false; //should set at the end all data fetching
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
    },
};
</script>
