<template>
    <v-container>
        <v-col cols="12">
            <div class = 'float-right'>
                <v-btn
                    variant="flat"
                    color='success'
                    icon="mdi-plus"
                    class="m-2"
                    @click=""
                ></v-btn>
            </div>
            <h2>Communities</h2>
        </v-col>

        <v-col cols="12" v-if="loading">
            Loading...
        </v-col>

        <v-col cols="12" v-if="communities.length <= 0 && !loading">
            No Communities
        </v-col>

        <v-divider></v-divider>

        <v-table v-if="communities.length > 0 && !loading">
            <thead>
                <tr>
                    <th> Name </th>
                    <th> Location </th>
                    <th> Added at </th>
                    <th> Actions </th>
                </tr>
            </thead>

            <tbody>
                <tr
                    v-for="item in communities"
                    :key="item.id"
                >
                    <td> {{ item.name }} </td>
                    <td>
                        <span v-if="item.city">{{ item.city }}, </span>
                        <span v-if="item.state">{{ item.state }}, </span>
                        <span v-if="item.country">{{ item.country }}</span>
                    </td>
                    <td>
                        {{ new Date(item.created_at).toLocaleDateString(undefined, { year: 'numeric', month: 'long', day: 'numeric' }) }}
                    </td>
                    <td>
                        <v-btn
                            variant="flat"
                            color="success"
                            class="ma-1"
                            icon="mdi-arrow-right"
                            size="x-small"
                            @click=""
                        ></v-btn>
                        <v-btn
                            variant="flat"
                            color="primary"
                            class="ma-1"
                            icon="mdi-pencil"
                            size="x-small"
                            @click=""
                        ></v-btn>
                        <v-btn
                            variant="flat"
                            color="error"
                            class="ma-1"
                            icon="mdi-delete"
                            size="x-small"
                            @click="handleConfirmModal(item)"
                        ></v-btn>
                    </td>
                </tr>
            </tbody>
        </v-table>

        <v-col md="12" v-if="pagination.pageCount > 1">
            <v-pagination
                v-model="currentPage"
                :length="pagination.pageCount"
                rounded="circle"
                @prev="handleChangePage"
                @next="handleChangePage"
                @update:modelValue="handleChangePage"
            ></v-pagination>
        </v-col>

        <modal-confirmation
            :show="confirmation.show"
            :questionParam="confirmation.question"
            :argsParam="confirmation.item"
            @on-cancel="handleConfirmModalDisplay(false)"
            @on-confirm="handleDeleteUser"
        ></modal-confirmation>
    </v-container>
</template>

<script>
export default {
    data: () => (
        {
            loading: true,
            communities: [],
            confirmation: {
                show: false,
                question: 'Are you sure you want to delete this Community?',
                item: null
            },
            pagination: {
                page: 1,
                pageCount: 1,
                total: 0
            },
            currentPage: 1
        }
    ),
    mounted() {
        this.fetchCommunities();
    },
    computed: {

    },
    methods: {
        fetchCommunities: function() {
            this.loading = true;

            let queryParameters = 'per_page=10&page='+this.currentPage;

            axios.get(window.baseURL+'/api/communities/me?'+queryParameters)
                .then(response => {
                    this.communities = response.data.collection;
                    this.pagination = response.data.pagination;
                    this.loading = false;
                })
        },
        handleDeleteUser: function(community) {
            this.loading = true;

            axios.delete('/api/communities/'+community.id)
                .then(response => {
                    this.handleConfirmModalDisplay(false);
                    this.fetchCommunities();
                });
        },
        handleConfirmModal: function(item) {
            this.handleConfirmModalDisplay(true);
            this.confirmation.item = item;
        },
        handleConfirmModalDisplay: function(display) {
            this.confirmation.show = display;
        },
        handleChangePage: function(page) {
            this.currentPage = page;
            this.fetchCommunities();
        },
    }
};
</script>