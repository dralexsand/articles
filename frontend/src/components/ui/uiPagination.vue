<template>
  <nav aria-label="Page navigation example">
    <ul class="list-style-none flex pagination">
      <li>
        <a
            :class="pgStyles.pgLinkClass"
            @click="onClickPage(1)"
        >
          {{ '<<' }}
        </a>
      </li>
      <li>
        <a
            :class="pgStyles.pgLinkClass"
            @click="onClickPage(pagination.currentPage === 1 ? 1 : pagination.currentPage-1)"
        >
          {{ '<' }}
        </a>
      </li>

      <li>
        <a
            :class="pgStyles.pgLinkClass"
            @click="onClickPage(pagination.currentPage)"
        >
          {{ pagination.currentPage }} page of {{ pagination.lastPage }}
        </a>
      </li>

      <li>
        <a
            :class="pgStyles.pgLinkClass"
            @click="onClickPage(pagination.currentPage === pagination.lastPage ? pagination.lastPage : pagination.currentPage+1)"
        >
          {{ '>' }}
        </a>
      </li>

      <li>
        <a
            :class="pgStyles.pgLinkClass"
            @click="onClickPage(pagination.lastPage)"
        >
          {{ '>>' }}
        </a>
      </li>

    </ul>

  </nav>
</template>
<script>
import {ref} from "vue";

export default {
  components: {},

  props: {
    pagination: {}
  },
  emits: [
    'handleSubmitPagination'
  ],
  setup(props, {emit}) {
    const onClickPage = (item) => {
      emit('handleSubmitPagination', {
        type: 'pagination',
        value: item,
      })
    }

    const pgStyles = ref({
      pgLinkClass: 'relative block rounded bg-transparent px-3 py-1.5 text-sm text-neutral-600 transition-all duration-300 hover:bg-neutral-100 dark:text-white dark:hover:bg-neutral-700 dark:hover:text-white',
    })

    return {
      pgStyles,
      onClickPage
    }
  }
}
</script>
<style scoped>
.pagination li a:hover {
  cursor: pointer;
}
</style>