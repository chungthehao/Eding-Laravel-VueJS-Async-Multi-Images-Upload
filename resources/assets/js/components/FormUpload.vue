<template>
    <!--<form action="/" method="post" enctype="multipart/form-data">-->
    <form @submit.prevent="handleSubmit">
        <!--{{ csrf_field() }}-->

        <div class="form-group">
            <label>Image</label>

            <file-input @file-change="setImage"></file-input>
            <!--<input type="file" class="" name="images[]" multiple>-->
        </div>

        <div class="text-right">
            <button class="btn btn-success" type="submit">Upload</button>
        </div>
    </form>
</template>

<script>
    import FileInput from './FileInput';

    export default {
        name: 'FormUpload',
        components: { FileInput },
        data() {
            return {
                image: {}
            };
        },
        methods: {
            handleSubmit() {
                let formData = new FormData();
                formData.append('images[]', this.image);

                axios.post('/api/images', formData)
                    .then(res => console.log('Upload completed!'))
                    .catch(err => console.log('Upload failed!'));
            },
            setImage(file) {
                this.image = file; // 2 biến object cùng trỏ tới 1 memory
            }
        }
    }
</script>

<style scoped></style>