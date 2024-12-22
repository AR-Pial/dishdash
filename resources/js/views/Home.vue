<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        I'm an example component.
                        <p>
                            {{ message }}
                        </p>
                    </div>
                   
                    
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapState, mapActions } from 'vuex';
    export default {

        computed: {
            // Map Vuex state to computed properties
            ...mapState('home', ['message'])
        },
        mounted() {
            console.log('Component mounted.')
            this.$axios.get('https://jsonplaceholder.typicode.com/posts')
            .then(response => {
                console.log(response.data); // Store posts in data
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
        }
    }
</script>
