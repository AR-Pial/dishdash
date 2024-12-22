<template>
    <div>
        <h1>About Page</h1>
        <p>This is the about page.</p>
        <p>{{ message }}</p>
    </div>
</template>

<script>
import { mapState, mapActions } from 'vuex';
export default {
    name: 'About',
    computed: {
            // Map Vuex state to computed properties
            ...mapState('about', ['message'])
        },
};
</script>
