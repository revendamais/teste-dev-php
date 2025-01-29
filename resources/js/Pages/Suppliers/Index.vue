<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

defineProps<{
    suppliers: Array<{ id: number, name: string, registration_number: string, email: string, phone: string }>
}>();

const form = useForm({
    search: ''
});

function submit() {
    form.get(route('suppliers.index'));
}
</script>

<template>

    <Head title="Fornecedores" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Fornecedores
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form @submit.prevent="submit" class="mb-4 flex items-center">                            

                            <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.search" placeholder="Informe a Razão Social" />

                            <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing">
                                Pesquisar
                            </PrimaryButton>

                            <Link :href="route('suppliers.create')"
                                class="ml-4 bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-4 rounded focus:outline-none focus:shadow-outline">
                                Novo
                            </Link>
                        </form>

                        <table class="border-collapse border border-slate-400 w-full">
                            <thead>
                                <tr>
                                    <th width="30%" class="border border-slate-300 p-2">Nome</th>
                                    <th width="15%" class="border border-slate-300 p-2">CNPJ/CPF</th>
                                    <th width="30%" class="border border-slate-300 p-2">E-mail</th>
                                    <th width="15%" class="border border-slate-300 p-2">Telefone</th>
                                    <th width="10%" class="border border-slate-300 p-2">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="supplier in suppliers" :key="supplier.id">
                                    <td class="border border-slate-300 p-2">{{ supplier.name }}</td>
                                    <td class="border border-slate-300 p-2">{{ supplier.registration_number }}</td>
                                    <td class="border border-slate-300 p-2">{{ supplier.email }}</td>
                                    <td class="border border-slate-300 p-2">{{ supplier.phone }}</td>
                                    <td class="border border-slate-300 p-2 text-center">
                                        <Link :href="route('suppliers.edit', supplier.id)"
                                            class="text-yellow-500 hover:underline ml-2" title="Editar"><i
                                            class="material-icons icon-color">edit</i></Link>
                                        <Link :href="route('suppliers.destroy', supplier.id)" method="delete"
                                            class="text-red-500 hover:underline ml-2" title="Deletar" as="button"><i
                                            class="material-icons icon-color">delete</i></Link>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
