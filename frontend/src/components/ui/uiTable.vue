<template>

  <ui-pagination
      :pagination="pagination"
      @handleSubmitPagination="onClickPagination"
  />

  <div class="flex flex-col">
    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
        <div class="overflow-hidden">

          <table
              v-show="posts.length"
              class="min-w-full text-left text-sm font-light">
            <thead class="border-b font-medium dark:border-neutral-500">
            <tr>
              <th scope="col"
                  :class="thClass">
                Title
              </th>
              <th scope="col"
                  :class="thClass">
                Description
              </th>
              <th scope="col"
                  :class="thClass">
                Published
              </th>
              <th scope="col" :class="thClass">
                Author
              </th>
              <th scope="col" :class="thClass">
                Actions
              </th>
            </tr>
            </thead>
            <tbody>
            <tr class="border-b dark:border-neutral-500"
                v-for="post in posts" :key="post.id">
              <td
                  :class="tdClass"
                  class="font-medium"
              >
                {{ post.title }}
              </td>
              <td
                  :class="tdClass">
                {{ post.description }}
              </td>
              <td
                  :class="tdClass">
                {{ post.created_at }}
              </td>
              <td
                  :class="tdClass">
                {{ post.author.full_name }}
              </td>
              <td
                  :class="tdClass">
                <div class="inline-flex">
                  <button
                      @click.prevent="onClickAction(post.id, 'view')"
                      class="hover:bg-gray-300 font-bold py-2 px-3 rounded-l">
                    <icon-view/>
                  </button>
                  <button
                      @click.prevent="onClickAction(post.id, 'edit')"
                      class="hover:bg-gray-300 font-bold py-2 px-3 rounded-r">
                    <icon-edit/>
                  </button>
                  <button
                      @click.prevent="onClickAction(post.id, 'delete')"
                      class="hover:bg-gray-300 font-bold py-2 px-3 rounded-r">
                    <icon-trash/>
                  </button>
                </div>
              </td>
            </tr>

            </tbody>
          </table>

        </div>
      </div>
    </div>
  </div>

  <ui-pagination
      :pagination="pagination"
      @handleSubmitPagination="onClickPagination"
  />

</template>
<script>
import {ref} from "vue";
import iconView from '../icons/iconView.vue'
import iconEdit from '../icons/iconEdit.vue'
import iconTrash from '../icons/iconTrash.vue'
import uiPagination from "./uiPagination.vue";

export default {
  components: {
    iconView,
    iconEdit,
    iconTrash,
    uiPagination
  },
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
    },
    pagination: {}
  },
  emits: [
    'handleSubmitTablePagination',
    'handleAction',
  ],
  setup(props, {emit}) {

    const onClickPagination = (item) => {
      emit('handleSubmitTablePagination', {
        type: 'pagination',
        value: item.value,
      })
    }

    const onClickAction = (item, type) => {
      emit('handleAction', {
        type: type,
        value: item,
      })
    }

    const thClass = ref('px-3 py-3');
    const tdClass = ref('px-3 py-3');

    return {
      tdClass,
      thClass,
      onClickPagination,
      onClickAction
    }
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
