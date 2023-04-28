<template>
  <table class="table table_main">
    <thead>
    <tr>
      <th>Title</th>
      <th>Description</th>
      <th>Published</th>
      <th>Author</th>
      <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <tr class="table_row"
        v-for="post in posts" :key="post.id">
      <td class="table_cell">{{ post.title }}</td>
      <td class="table_cell">{{ post.description }}</td>
      <td class="table_cell">{{ post.created_at }}</td>
      <td class="table_cell">{{ post.author.full_name }}</td>
      <td class="table_cell">
        <div class="inline-flex">
          <button
              class="hover:bg-gray-300 font-bold py-2 px-3 rounded-l">
            <icon-view/>
          </button>
          <button
              class="hover:bg-gray-300 font-bold py-2 px-3 rounded-r">
            <icon-edit/>
          </button>
          <button
              class="hover:bg-gray-300 font-bold py-2 px-3 rounded-r">
            <icon-trash/>
          </button>
        </div>
      </td>
    </tr>

    </tbody>
  </table>
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
  padding: 15px;
}
.table_row {
  background-color: #8be2ef;
  border-radius: 3px;
  border: 1px solid silver;
}

.table_row:hover {
  background-color: #66dff1;
  cursor: pointer;
}

.table_cell {
  background-color: #c3e6ea;
  border-radius: 3px;
  border: 1px solid silver;
  padding: 5px;
}

</style>
