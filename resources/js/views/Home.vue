<template>
  <div>
    <div class="row">
      <div class="col-12">
        <div class="h4 text-center text-gray-900 my-3">Add Shopping List</div>
      </div>
    </div>

    <div class="row mb-3">
      <form class="w-100" method="POST" @submit.prevent="storeList">
        <div class="input-group mb-3">
          <input
            id="name"
            v-model="name"
            type="text"
            class="form-control"
            placeholder="New shopping list"
            aria-label="New shopping list"
            aria-describedby="button-addon2"
            name="name"
            required
            :class="{'is-invalid': errors.length}"
          />
          <div class="input-group-append">
            <button
              class="btn btn-primary"
              type="submit"
              id="button-addon2"
              :disabled="!name.length"
            >Add</button>
          </div>
          <div class="invalid-feedback d-block" v-if="errors.length">{{errors[0]}}</div>
        </div>
      </form>
    </div>

    <div class="row">
      <div class="col-12">
        <div class="h4 text-center text-gray-900 my-3">My Shopping List</div>
        <div class="text-center" v-if="loading">
          <Loading></Loading>
        </div>
        <div v-else>
          <div v-if="lists.length">
            <ul class="list-group">
              <router-link
                :to="'list/' + list.id"
                class="list-group-item list-group-item-action"
                v-for="list in lists"
                :key="list.id"
              >
                <div class="d-flex align-items-center justify-content-between">
                  <p class="m-0">{{ list.name }}</p>
                  <button @click="destroyList(list.id)" class="btn btn-sm btn-outline-danger">
                    <i class="fas fa-trash-alt" aria-hidden="true"></i>
                  </button>
                </div>
              </router-link>
            </ul>
          </div>
          <div v-else class="text-center">Your shopping list is empty.</div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Loading from "../components/Loading.vue";

export default {
  mounted() {
    this.fetchLists();
  },
  data() {
    return {
      name: "",
      loading: true,
      lists: [],
      errors: []
    };
  },
  components: {
    Loading
  },
  methods: {
    fetchLists() {
      axios
        .get("api/lists")
        .then(response => {
          this.lists = response.data;
        })
        .finally(() => (this.loading = false));
    },

    storeList() {
      this.loading = true;
      axios
        .post("api/lists", { name: this.name })
        .then(response => {
          this.name = "";
          this.fetchLists();
        })
        .catch(error => {
          this.errors = error.response.data.errors.name;
        })
        .finally(() => (this.loading = false));
    },

    destroyList(id) {
      this.loading = true;
      axios
        .delete("api/lists/" + id)
        .then(response => {
          this.fetchLists();
        })
        .finally(() => (this.loading = false));
    }
  }
};
</script>
