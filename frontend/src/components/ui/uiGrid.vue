<template>

  <div class="table_main p-1 m-1">

    <div class="p-1 grid grid-cols-5 gap-5 place-content-center h-12">
      <div class="table_cell">Title</div>
      <div class="table_cell">Description</div>
      <div class="table_cell">Published</div>
      <div class="table_cell">Author</div>
      <div class="table_cell">

        <div class="inline-flex">
          <button class="hover:bg-gray-300 font-bold py-2 px-3 rounded-l">
            <icon-view/>
          </button>
          <button class="hover:bg-gray-300 font-bold py-2 px-3 rounded-r">
            <icon-edit/>
          </button>
          <button class="hover:bg-gray-300 font-bold py-2 px-3 rounded-r">
            <icon-trash/>
          </button>
        </div>
      </div>
    </div>

    <div
        v-for="post in posts" :key="post.id"
        class="p-1 grid grid-cols-5 gap-5 place-content-center h-12">
      <div class="table_cell">{{ post.title }}</div>
      <div class="table_cell">{{ post.description }}</div>
      <div class="table_cell">{{ post.created_at }}</div>
      <div class="table_cell">{{ post.author.full_name }}</div>
      <div class="table_cell">

        <div class="inline-flex">
          <button class="hover:bg-gray-300 font-bold py-2 px-3 rounded-l">
            <icon-view/>
          </button>
          <button class="hover:bg-gray-300 font-bold py-2 px-3 rounded-r">
            <icon-edit/>
          </button>
          <button class="hover:bg-gray-300 font-bold py-2 px-3 rounded-r">
            <icon-trash/>
          </button>
        </div>
      </div>
    </div>

  </div>

</template>
<script>

import iconView from '../icons/iconView.vue'
import iconEdit from '../icons/iconEdit.vue'
import iconTrash from '../icons/iconTrash.vue'

export default {
  props: {
    posts: {
      id: {},
      title: {},
      description: {},
      created_at: {},
      author: {
        id: {},
        full_name: {}
      },
    }
  },
  components: {
    iconView,
    iconEdit,
    iconTrash
  },
  setup() {

    return {}
  }
}
</script>
<style scoped>
.table_main {
  background-color: white;
  border-radius: 5px;
}

.table_cell {
  background-color: #8be2ef;
  border-radius: 3px;
  padding: 5px;
}

</style>
