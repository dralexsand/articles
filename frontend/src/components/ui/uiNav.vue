<template>
  <nav class="bg-cyan-500">
    <router-link
        v-for="item in items"
        :to="item.path">
      {{ item.name }}
      <span class="nav_divider"></span>
    </router-link>
  </nav>
</template>

<script>
import router from '../../router/index.js'
import {onMounted, ref} from "vue";

export default {

  setup() {

    let items = ref([])

    onMounted(() => {

      let item = {}
      let newSortItems = []

      router.getRoutes().forEach(function (value) {
        if (value.meta.position === 'topnav') {
          item = {
            path: value.path,
            name: value.name,
          }
          newSortItems[value.meta.order] = item
        }
      })

      newSortItems.forEach(function (item) {
        items.value.push(item)
      })

    })

    return {
      items
    }
  }
}
</script>

<style scoped>
nav {
  padding: 20px;
}

a {
  font-weight: bold;
  color: #007575;
  list-style-type: none;
  text-decoration: none;
}


span.nav_divider {
  width: 5px;
  height: 1px;
  padding: 10px;
}
</style>