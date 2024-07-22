<template>
    <nav :style="{ backgroundColor: navbarColor }" class="navbar">
        <div class="container">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="#">Tasks</a></li>
                <li class="nav-item"><a class="nav-link" href="#">People</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Business</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Tags</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Categories</a></li>
            </ul>
        </div>
    </nav>
</template>

<script>
export default {
    data() {
        return {
            navbarColor: '#cf2e2e'
        };
    },
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

    .nav-item {
        display: inline;
    }

    .nav-link {
        color: white;
        text-decoration: none;
        font-size: 1em;
    }

    .nav-link:hover {
        color: #ffd700; /* Gold */
    }
</style>