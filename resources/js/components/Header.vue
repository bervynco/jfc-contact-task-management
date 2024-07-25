<template>
    <nav :style="{ backgroundColor: navbarColor }" class="navbar">
        <div class="container">
            <ul class="navbar-nav flex space-x-4">
                <li class="nav-item relative">
                    <router-link class="nav-link" to="/tasks">Tasks</router-link>
                </li>
                <li class="nav-item relative">
                    <router-link class="nav-link" to="/categories">Categories</router-link>
                </li>
                <li class="nav-item relative">
                    <router-link class="nav-link" to="/people">People</router-link>
                </li>
                <li class="nav-item relative">
                    <router-link class="nav-link" to="/business">Business</router-link>
                </li>
                <li class="nav-item relative">
                    <router-link class="nav-link" to="/tags">Tags</router-link>
                </li>
            </ul>
        </div>
    </nav>
</template>
<script>
export default {
    name: "Header",
    data() {
        return {
            navbarColor: '#cf2e2e'
        };
    },
    methods: {
       
    }
};
</script>
<style scoped>
    .navbar {
        padding: 10px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        color: white;
    }

    .navbar-brand {
        font-size: 1.5em;
        font-weight: bold;
    }

    .navbar-nav {
        list-style: none;
        display: flex;
        gap: 20px;
    }

    .nav-link {
        color: white;
        text-decoration: none;
        font-size: 1em;
    }

    .nav-link:hover {
        color: #ffd700;
    }
    .nav-item {
        position: relative;
    }
</style>