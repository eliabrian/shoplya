<template>
  <div>
    <div class="row">
      <div class="col-12">
        <div class="text-center text-gray-900 my-3">
          <div class="h4">{{ list.name }}</div>
        </div>
      </div>
    </div>
    <div class="row mb-5">
      <button class="btn btn-secondary btn-block" @click="showForm = !showForm">
        <span v-if="!showForm">Add Item</span>
        <span v-if="showForm">Cancel</span>
      </button>
      <div v-if="showForm" class="mt-3 w-100">
        <form method="POST" @submit.prevent="storeItem">
          <div class="form-group">
            <input
              type="text"
              class="form-control"
              id="name"
              name="name"
              placeholder="Item name..."
              v-model="name"
              :class="{'is-invalid': errors.name}"
            />
            <div class="invalid-feedback d-block" v-if="errors.name">{{errors.name[0]}}</div>
          </div>
          <div class="row">
            <div class="col">
              <input
                type="number"
                min="1"
                class="form-control"
                id="quantity"
                name="quantity"
                placeholder="Quantity..."
                v-model="quantity"
                :class="{'is-invalid': errors.quantity}"
              />
              <div class="invalid-feedback d-block" v-if="errors.quantity">{{errors.quantity[0]}}</div>
            </div>
            <div class="col">
              <button class="btn btn-primary w-100" type="submit" :disabled="!name.length">
                <div v-if="loading">
                  <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                  Loading...
                </div>
                <div v-else>Add</div>
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="row mb-5">
      <div class="col-12">
        <div class="text-center" v-if="loading">
          <Loading></Loading>
        </div>
        <div v-else>
          <div v-if="items.length">
            <ul class="list-group">
              <li
                class="list-group-item d-flex justify-content-between"
                v-for="item in items"
                :key="item.id"
              >
                <div class="form-check form-check-inline">
                  <input
                    class="form-check-input"
                    type="checkbox"
                    id="item"
                    v-on:change="completeItem(item.id)"
                    :checked="item.completed"
                  />
                  <label class="form-check-label" for="item">{{ item.name }}</label>
                </div>
                <button class="btn btn-sm btn-danger" @click="destroyItem(item.id)">
                  <i class="fas fa-trash-alt" aria-hidden="true"></i>
                </button>
              </li>
            </ul>
          </div>
          <div v-else class="text-center">There is no item on this list.</div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Loading from "../components/Loading.vue";

export default {
  name: "List",
  props: ["id"],
  mounted() {
    this.fetchItems();
    this.fetchList();
  },
  components: {
    Loading
  },
  data() {
    return {
      loading: true,
      showForm: false,
      name: "",
      quantity: "",
      completed: "",
      items: [],
      list: {},
      errors: {}
    };
  },
  methods: {
    fetchItems() {
      axios
        .get("/api/lists/" + this.id + "/items")
        .then(response => {
          this.items = response.data;
        })
        .finally(() => {
          this.loading = false;
        });
    },

    fetchList() {
      axios.get("/api/lists/" + this.id).then(response => {
        this.list = response.data;
      });
    },

    storeItem() {
      this.loading = true;
      let name = this.name;
      let quantity = this.quantity;
      let lists_id = this.id;

      axios
        .post("/api/items", { name, quantity, lists_id })
        .then(response => {
          this.name = "";
          this.quantity = "";
          this.fetchItems();
        })
        .catch(error => {
          this.errors = error.response.data.errors;
        })
        .finally(() => {
          this.loading = false;
        });
    },

    completeItem(id) {
      axios.put("/api/items/" + id + "/complete").then(response => {
        this.fetchLists();
      });
    },

    destroyItem(id) {
      axios.delete("/api/items/" + id).then(response => {
        this.fetchItems();
      });
    }
  }
};
</script>