<template>

  <div class="flex flex-col">
    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
        <div class="overflow-hidden">

          <table
              class="min-w-full text-left text-sm font-light">
            <thead class="border-b font-medium dark:border-neutral-500">
            <tr>
              <th scope="col"
                  :class="thClass">
                Filter
              </th>
              <th scope="col"
                  :class="thClass">
                Value
              </th>
            </tr>
            </thead>
            <tbody>
            <tr class="border-b dark:border-neutral-500">
              <td
                  :class="tdClass"
                  class="font-medium"
              >
                <input
                    type="checkbox"
                    :name="form.name"
                    :class="form.class"
                    :checked="formValue"
                    @change="onChange(formValue, form.name)"
                />
                <label class="ml-2 text-sm" :for="form.name">
                  {{ form.label }}
                </label>

              </td>

              <td
                  :class="tdClass"
                  class="font-medium"
              >
                <input
                    type="text"
                    :name="form.name"
                    :class="form.class"
                    placeholder=""
                    v-model="formValue"
                    @change="onChange(formValue, form.name)"
                >
              </td>
            </tr>

            </tbody>
          </table>

        </div>
      </div>
    </div>
  </div>

</template>
<script>

import {ref} from "vue";

export default {
  props: {
    form: {
      class: {},
      label: {},
      name: {},
    }
  },
  emits: [
    'handleUiCheckBox'
  ],
  setup(props, {emit}) {

    const formValue = ref(false);

    const onChange = (value, name) => {
      emit('handleUiCheckBox', {
        name: name,
        value: value
      })
    }

    const thClass = ref('px-3 py-3');
    const tdClass = ref('px-3 py-3');

    return {
      tdClass,
      thClass,
      formValue,
      onChange,
    }

  }
}
</script>
<style scoped>
.block {
  padding: 5px;
}

.block input {
  padding-left: 25px;
}
</style>