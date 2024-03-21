<script setup>
    import conciseSlider from 'vue-concise-slider';
</script>

<template>
  <div>
    <concise-slider :data="sliderData"></concise-slider>
  </div>
</template>
<script>

export default {
    data() {
        return {
          sliderData: [
            { image: 'path-to-image-1', caption: 'Caption 1' },
            { image: 'path-to-image-2', caption: 'Caption 2' },
            { image: 'path-to-image-3', caption: 'Caption 3' }
            // Agrega más objetos con la información de tus imágenes y captions
          ]
        };
      }
}

</script>
  