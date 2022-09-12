<template>
  <div class="text-center mt-16">
    <v-pagination
      v-model="page"
      :length="length"
    ></v-pagination>
  </div>
</template>

<script>
export default {
    props: ['length'],
    data() {
        return {
            page: 1
        }
    },
    watch: {
        page: {
            handler() {
                this.$emit('switchPage')
            }
        }
    }
}
</script>