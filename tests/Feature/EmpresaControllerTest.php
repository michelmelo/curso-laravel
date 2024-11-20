<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Empresa;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmpresaControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Testa se o índice lista as empresas corretamente.
     * Este teste verifica se a página de listagem de empresas exibe corretamente
     * as empresas criadas pelo usuário autenticado.
     */
    public function test_empresas_index_displays_companies()
    {
        // Cria um usuário e autentica-o
        $user = User::factory()->create();
        $this->actingAs($user);

        // Cria 3 empresas associadas ao usuário autenticado
        Empresa::factory()->count(3)->create(['user_id' => $user->id]);

        // Faz uma requisição GET para a rota de listagem de empresas
        $response = $this->get(route('empresas.index'));

        // Verifica se a resposta foi bem-sucedida (status 200)
        $response->assertStatus(200);

        // Confirma que o nome da primeira empresa aparece na página
        $response->assertSeeText(Empresa::first()->nome);
    }

    /**
     * Testa a criação de uma empresa.
     * Este teste valida se o formulário de criação de empresas
     * está funcionando corretamente e se os dados são salvos no banco.
     */
    public function test_store_creates_a_new_empresa()
    {
        // Cria um usuário e autentica-o
        $user = User::factory()->create();
        $this->actingAs($user);

        // Dados simulados enviados pelo formulário
        $data = [
            'nome' => 'Empresa Teste',
            'telefone' => '123456789',
            'email' => 'empresa@teste.com',
            'ativo' => true,
        ];

        // Faz uma requisição POST para criar a empresa
        $response = $this->post(route('empresas.store'), $data);

        // Verifica se o usuário foi redirecionado para a página de listagem
        $response->assertRedirect(route('empresas.index'));

        // Confirma que os dados foram salvos corretamente no banco
        $this->assertDatabaseHas('empresas', $data);
    }

    /**
     * Testa a edição de uma empresa.
     * Este teste valida se a funcionalidade de atualização de uma empresa está
     * funcionando corretamente e atualiza os dados no banco de dados.
     */
    public function test_update_edits_an_empresa()
    {
        // Cria um usuário e autentica-o
        $user = User::factory()->create();
        $this->actingAs($user);

        // Cria uma empresa associada ao usuário autenticado
        $empresa = Empresa::factory()->create(['user_id' => $user->id]);

        // Novos dados para atualizar a empresa
        $data = [
            'nome' => 'Empresa Editada',
            'telefone' => '987654321',
            'email' => 'editado@empresa.com',
            'ativo' => false,
        ];

        // Faz uma requisição PUT para atualizar a empresa
        $response = $this->put(route('empresas.update', $empresa), $data);

        // Verifica se o usuário foi redirecionado para a página de listagem
        $response->assertRedirect(route('empresas.index'));

        // Confirma que os dados atualizados estão no banco de dados
        $this->assertDatabaseHas('empresas', $data);
    }

    /**
     * Testa a exclusão de uma empresa.
     * Este teste verifica se a funcionalidade de exclusão está funcionando
     * e se a empresa é removida do banco de dados.
     */
    public function test_destroy_deletes_an_empresa()
    {
        // Cria um usuário e autentica-o
        $user = User::factory()->create();
        $this->actingAs($user);

        // Cria uma empresa associada ao usuário autenticado
        $empresa = Empresa::factory()->create(['user_id' => $user->id]);

        // Faz uma requisição DELETE para excluir a empresa
        $response = $this->delete(route('empresas.destroy', $empresa));

        // Verifica se o usuário foi redirecionado para a página de listagem
        $response->assertRedirect(route('empresas.index'));

        // Confirma que a empresa foi removida do banco de dados
        $this->assertDatabaseMissing('empresas', ['id' => $empresa->id]);
    }

    /**
     * Testa a autorização para editar uma empresa de outro usuário.
     * Este teste garante que um usuário não pode editar empresas de outro usuário.
     */
    public function test_cannot_update_empresa_of_another_user()
    {
        // Cria dois usuários
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        // Autentica o segundo usuário
        $this->actingAs($user2);

        // Cria uma empresa associada ao primeiro usuário
        $empresa = Empresa::factory()->create(['user_id' => $user1->id]);

        // Dados para tentar atualizar a empresa
        $data = [
            'nome' => 'Tentativa de Edição',
        ];

        // Faz uma requisição PUT para tentar atualizar a empresa
        $response = $this->put(route('empresas.update', $empresa), $data);

        // Verifica se a resposta é 403 (acesso negado)
        $response->assertStatus(403);

        // Confirma que o nome da empresa não foi alterado
        $this->assertDatabaseMissing('empresas', ['nome' => 'Tentativa de Edição']);
    }
}
