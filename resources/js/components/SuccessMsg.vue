<template>
  <v-alert
    type="success"
    class="mt-5"
    >
        {{ msg }}
    </v-alert>
</template>

<script>
export default {
    props: ['msg']
}
</script>

<style>

</style>