<template>
  <!--  <div class="max-w-7xl px-2 sm:px-6 lg:px-8 bg-cyan-500 h-16">-->

  <ui-nav-base />

  <router-view/>

</template>
<script>
import uiNav from "./components/ui/uiNav.vue";
import uiNavBase from "./components/ui/uiNavBase.vue";

export default {
  components: {
    uiNav,
    uiNavBase
  },
  setup() {

    return {}
  }
}
</script>