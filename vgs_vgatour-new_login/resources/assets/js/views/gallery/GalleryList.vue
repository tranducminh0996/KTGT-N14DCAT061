<template>
    <el-row>
        <el-row class="box-search__tournament">
            <el-col :sm="12">
                <el-select
                    class="w-100"
                    v-model="objectData.tournament_id"
                    filterable
                    remote
                    reserve-keyword
                    :placeholder="$t('gallery.title_search')"
                    :remote-method="onSearchTournament"
                    :loading="loading">
                    <el-option
                        v-for="tournament in tournaments"
                        :key="tournament.value"
                        :label="tournament.label"
                        :value="tournament.value">
                    </el-option>
                </el-select>
            </el-col>
            <el-col :sm="12">
                <el-upload
                    drag
                    multiple
                    class="import-file-excel"
                    accept="image/*"
                    :action="`${baseUrl}/cms/galleries`"
                    :data="objectData"
                    :headers="objectHeader"
                    :show-file-list="false"
                    :on-success="handleUploadSuccess"
                    :before-upload="beforeUploadFile">
                    <el-button :loading="loadingUploadImage" class="avatar-uploader-icon" icon="el-icon-upload" > Import File</el-button>
                </el-upload>
            </el-col>
        </el-row>
        <template v-if="imageExist.length > 0">
            <div class="clearfix-10"></div>
            <label>Ảnh đã tồn tại: </label> <el-tag v-for="(item, index) in imageExist" :key="index" type="warning">{{ item }}</el-tag>
        </template>
        <div class="clearfix-10"></div>
        <el-row>
            <div class="text-right">
                <el-button type="primary" icon="el-icon-refresh" round @click="onGetGalleryList"> Reload</el-button>
            </div>
        </el-row>
        <div class="clearfix-10"></div>
        <el-row v-loading="loadingData">
            <el-col v-if="images.length === 0">
                <div class="text-center"><i>Không tìm thấy ảnh giải đấu này.</i></div>
            </el-col>
            <viewer :images="listImages">
                <el-col :sm="2" class="lg-pr-5" v-for="(image, index) in images" :key="index">
                    <img class="w-100" :src="image.img_convert">
                </el-col>
            </viewer>
        </el-row>
        <el-row>
            <pagination v-show="total > listQuery.limit" :total="total" :limit.sync="listQuery.limit" :page.sync="listQuery.page" @pagination="onGetGalleryList" />
        </el-row>
    </el-row>
</template>

<script>
import Pagination from '../../components/Pagination';
import Resource from '../../api/resource';
const getTournamentResource = new Resource('cms/get-tournament');
const GalleryListResource = new Resource('cms/galleries');
import NProgress from 'nprogress';
import InfiniteLoading from 'vue-infinite-loading';
export default {
    name: 'GalleryList',
    components: { InfiniteLoading, Pagination },
    data() {
        return {
            objectData: {},
            objectHeader: {},
            loadingUploadImage: false,
            baseUrl: window.baseUrl,
            tournaments: [],
            loading: false,
            listImages: [],
            images: [],
            imageExist: [],
            listQuery: {
                limit: 50,
                page: 1,
                action: 1
            },
            total: 0,
            loadingData: false,
        }
    },
    created() {
        this.onGetGalleryList();
    },
    methods: {
        onGetGalleryList() {
            this.loadingData = true;
            this.listQuery.tournament_id = this.objectData.tournament_id;
            GalleryListResource.list(this.listQuery).then(response => {
                this.loadingData = false;
                const result = response.data;
                const images = result.data;
                if (images.data.length > 0) {
                    images.data.map(item => {
                        this.listImages.push(item.img_url);
                    })
                }
                this.images = [...images.data];
                this.total = images.total;
            });
        },
        onSearchTournament(keyword) {
            const params = { keyword: keyword };
            getTournamentResource.list(params).then(response => {
                const result = response.data;
                if (result.data.length > 0) {
                    result.data.map(value => {
                        const item = { label: value.name, value: value.id };
                        this.tournaments.push(item);
                    })
                } else {
                    this.tournaments = [];
                }
            });
        },
        handleUploadSuccess(response) {
            const code = response.error_code;
            NProgress.done();
            switch (code) {
                case 1:
                    this.$message.success(response.message);
                    break;
                case 2:
                    this.$message.warning(response.message);
                    if (response.data) {
                        this.imageExist.push(response.data);
                    }
                    break;
                default:
                    this.$message.error(response.message);
                    break;
            }
        },
        beforeUploadFile(file) {
            this.objectData['_token'] = window.token
            NProgress.start();
        }
    }
}
</script>

<style lang="scss">
    .clearfix-10 {
        clear: both;
        height: 10px;
    }
    .el-upload {
        width: 100%;
        .el-upload-dragger {
            width: 100%;
            height: auto;
            .el-icon-upload {
                margin: 0;
                font-size: 27px;
                line-height: 12px;
            }
        }
        .el-button--medium {
            padding: 7px 20px;
        }
    }
    .lg-pr-5 {
        padding-right: 5px;
    }
</style>
