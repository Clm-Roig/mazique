<script setup lang="ts">
import { ref } from "vue";

const hello = ref("");
const name = ref("");

const refreshHello = () => {
  if (name) {
    fetch("/api/helloword/" + name.value, { method: "GET" })
      .then((response) => response.json())
      .then((result) => (hello.value = result));
  }
};
</script>

<template>
  <input type="text" v-model="name" />
  <button @click="refreshHello">Demander un bonjour !</button>
  <h1 v-show="!!hello">{{ hello }}</h1>
</template>

<style scoped lang="scss"></style>
