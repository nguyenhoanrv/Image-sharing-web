<template>
  <div class="row d-flex justify-content-between align-items-center mt-4">
    <div class="col-sm-12 col-md-5">
      <div
        class="dataTables_info"
        id="datatable_info"
        role="status"
        aria-live="polite"
        v-text="getText()"
      ></div>
    </div>
    <div class="col-sm-12 col-md-7">
      <div class="dataTables_paginate paging_simple_numbers">
        <ul class="pagination justify-content-end">
          <li
            class="paginate_button page-item previous"
            :class="{ disabled: currentPage <= 1 }"
            @click="previousClick"
          >
            <span class="page-link">Previous</span>
          </li>
          <li
            class="paginate_button page-item"
            v-for="page of total_page"
            :key="page"
            :class="{ active: page === currentPage }"
            @click="changePage(page)"
          >
            <span class="page-link">{{ page }}</span>
          </li>

          <li
            class="paginate_button page-item next"
            :class="{ disabled: currentPage >= total_page }"
            @click="nextClick"
          >
            <span class="page-link"> Next </span>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    total: Number,
    total_page: Number,
    per_page: String,
  },
  data() {
    return {
      range: [],
      currentPage: 1,
    };
  },
  methods: {
    nextClick() {
      if (this.currentPage < this.total_page) {
        this.currentPage++;
        this.$emit("paginate", this.currentPage);
      }
    },
    previousClick() {
      if (this.currentPage > 1) {
        this.currentPage--;
        this.$emit("paginate", this.currentPage);
      }
    },
    changePage(page) {
      this.currentPage = page;
      this.$emit("paginate", page);
    },
    getText() {
      let from = (this.currentPage - 1) * this.per_page + 1;
      let to;
      if (this.currentPage === this.total_page) {
        to = this.total;
      } else {
        to = this.currentPage * this.per_page;
      }
      return `Showing ${from} to ${to} of ${this.total} entries`;
    },
  },
};
</script>

<style>
li.paginate_button {
  cursor: pointer;
}
li.paginate_button.disabled {
  cursor: auto;
}
</style>