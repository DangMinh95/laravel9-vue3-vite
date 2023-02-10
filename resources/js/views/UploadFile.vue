<template>
  <span>
    <p>Chọn multi file để upload</p>
    <input type="file" ref="file" multiple="multiple">
    <button @click="uploadFile">Upload multi file</button>
  </span>
  <span>
    <p>Chọn image upload</p>
    <input type="file" ref="image" @change="imageChange">
    <button @click="uploadImage">Upload image</button>
    <img :src="image">
  </span>

</template>

<script>
import axios from "axios";

export default {
  name: "UploadFile.vue",
  data() {
    return {
      image: ''
    }
  },
  methods: {
    uploadFile() {
      const formData = new FormData();

      for (let i = 0; i < this.$refs.file.files.length; i++) {
        let file = this.$refs.file.files[i];
        formData.append('files[' + i + ']', file);
      }

      axios.post('api/multifile', formData, {
          headers: {
            'Content-Type': 'multipart/form-data'
          },
        }
      )
    },
    uploadImage() {
      axios.post('api/image', {
        imagebase64: this.image
      })
    },
    imageChange() {
      let image = this.$refs.image.files[0];
      const reader = new FileReader();
      reader.onloadend = (e) =>  {
        this.image = e.target.result;
      };
      reader.readAsDataURL(image);
    }
  }
}
</script>

<style scoped>

</style>
