<?php

/**
 * PostgreSQL.modelo.php
 * Modelo que gestiona operaciones específicas de PostgreSQL
 */
class PostgreSQLModelo
{
    /**
     * Ejecuta una transacción en la base de datos
     * 
     * @param array $queries Array de consultas SQL a ejecutar
     * @return bool Éxito o fracaso de la transacción
     */
    static public function ejecutar_transaccion($queries)
    {
        $pdo = ConexionModelo::conectar();

        if (!$pdo) {
            return false;
        }

        try {
            $pdo->beginTransaction();

            foreach ($queries as $query) {
                $stmt = $pdo->prepare($query['sql']);
                $stmt->execute($query['params'] ?? []);
            }

            $pdo->commit();
            return true;
        } catch (PDOException $e) {
            $pdo->rollBack();
            echo "Error en la transacción: " . $e->getMessage();
            return false;
        }
    }
}
