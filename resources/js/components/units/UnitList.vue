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
            <h2>Units</h2>
        </v-col>

        <v-col cols="12" v-if="loading">
            Loading...
        </v-col>

        <v-col cols="12" v-if="units.length <= 0 && !loading">
            No Units
        </v-col>

        <v-divider></v-divider>

        <v-table v-if="units.length > 0 && !loading">
            <thead>
                <tr>
                    <th> Name </th>
                    <th> Address </th>
                    <th> Tags </th>
                    <th> Actions </th>
                </tr>
            </thead>

            <tbody>
                <tr
                    v-for="item in units"
                    :key="item.id"
                >
                    <td> {{ item.label }} </td>
                    <td>
                        <span v-if="item.address">{{ item.address }}, </span>
                        <span v-if="community.city">{{ community.city }}, </span>
                        <span v-if="community.state">{{ community.state }}, </span>
                        <span v-if="community.country">{{ community.country }}</span>
                    </td>
                    <td>
                        <v-chip
                            class="ma-2"
                            color="success"
                            outlined
                        >
                            Tag
                        </v-chip>
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
    </v-container>
</template>

<script>
export default {
    props: ['community'],
    data: () => (
        {
            loading: true,
            units: [],
            pagination: {
                page: 1,
                pageCount: 1,
                total: 0
            },
            currentPage: 1
        }
    ),
    mounted() {
        this.fetchUnits();
    },
    computed: {

    },
    methods: {
        fetchUnits: function() {
            this.loading = true;

            let queryParameters = 'estate='+this.community.id+'&per_page=10&page='+this.currentPage;

            axios.get(window.baseURL+'/api/units?'+queryParameters)
                .then(response => {
                    this.units = response.data.collection;
                    this.pagination = response.data.pagination;
                    this.loading = false;
                })
        },
        handleChangePage: function(page) {
            this.currentPage = page;
            this.fetchUnits();
        },
    }
};
</script>