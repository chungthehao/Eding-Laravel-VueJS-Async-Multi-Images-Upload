<template>
    <div>
        <div v-if="images.length">
            <div v-for="(image, idx) in images" :key="idx"
                 class="col-md-4">
                <div class="thumbnail">
                    <img :src="image.link" alt="">

                    <div class="caption">
                        <h3>{{ image.title }}</h3>
                    </div>
                </div>
            </div>
        </div>


        <div v-else class="col-md-12 text-center">
            <h3 class="text-warning">
                No images
            </h3>
        </div>
    </div>
</template>

<script>
    import EventBus from '../eventBus';

    export default {
        name: 'Images',
        data() {
            return {
                images: []
            };
        },
        created() {
            this.fetchImages();
            EventBus.$on('images-just-uploaded', () => {
                console.log('Cần fetch images mới!');
                this.fetchImages();
            });
        },
        methods: {
            fetchImages() {
                axios
                    .get('/api/images')
                    .then(res => this.images = res.data);
            }
        }
    }
</script>