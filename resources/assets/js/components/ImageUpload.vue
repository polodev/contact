<template>
  <div>
    <h1>Image upload</h1>
    <div id="croppie"></div>
    <div class="image-upload-wrapper">
      <div class="control">
        <input type="file" name="file" id="file" v-on:change="setupFileUploader">
      </div>
      <button class="button is-success" v-on:click="uploadFile">upload</button>
    </div>
  </div>
</template>

<script>
import Croppie from 'croppie'
export default {
  mounted () {
    this.image = this.form.gender ==  1 ? 'http://localhost:8000/storage/avatars/default/male.png' : 'http://localhost:8000/storage/avatars/default/female.png'
    // this.setupCroppie();
    this.$on('imageUploaded', imageData => {
      this.image = imageData
      if (this.croppie) {
        this.croppie.destroy()
      }
      this.setupCroppie()
    })
  },
  data () {
    return {
      image: null,
      croppie: null,
      userAddedImage: false,
      form: {
        gender: 0
      }
    }
  },
  props: ['imageUrl'],
  methods: {
    setupCroppie () {
      var el = document.getElementById('croppie');
      this.croppie = new Croppie ( el, {
        viewport: { width: 220, height: 220 },
        boundary: { width: 300, height: 300 },
        showZoomer: true,
        enableOrientation: false
      })
      this.croppie.bind({
        url: this.image,
        orientation: 4
    });
    },
    setupFileUploader (e) {
      let files = e.target.files || e.dataTransfer.files;
      if (!files.length) {
        return ;
      }
      this.createImage(files[0]);
    },
    createImage (file) {
      var image = new Image();
      var reader = new FileReader();
      this.userAddedImage = true;
      var vm = this;
      reader.onload = e => {
        vm.image = e.target.result
        vm.$emit('imageUploaded', e.target.result)
      }
      reader.readAsDataURL(file);
    },
    uploadFile () {
      this.croppie.result({
        type: 'canvas',
        size: 'viewport',
      }).then(response => {
        axios.post('/upload',{avatar: this.image}).then(response => {
          console.log('response', response);
        });
      })
    }
  }
}
</script>

<style lang="scss">
.image-upload-wrapper {
  padding: 10px 0;
  input {
    margin-bottom: 10px;
  }

}
</style>
