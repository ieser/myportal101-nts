<?php
namespace Modules\Moulds\Models;
use \Core\Base\Database as DB;

class MouldWarrantyModel {

    private $id;
    public $mould;
    public $startDate;
    public $startStrokes;
    public $guaranteedPart;
    public $guaranteedStrokes;
    public $isTotalWarranty;
    public $notes;

    public function __construct($mould = null, $id = null) {
        if ($mould) {
            $this->mould = $mould;
        }
        if ($id) {
            $this->id = $id;
        }
    }

    public function load() {
        $result = DB::sql()->select("SELECT * FROM mould_warranties WHERE mould = ? AND id = ?", [$this->mould, $this->id]);
        if (!empty($result)) {
            $warranty = $result[0];
            $this->startDate = $warranty['startDate'];
            $this->startStrokes = $warranty['startStrokes'];
            $this->guaranteedPart = $warranty['guaranteedPart'];
            $this->guaranteedStrokes = $warranty['guaranteedStrokes'];
            $this->isTotalWarranty = $warranty['isTotalWarranty'];
            $this->notes = $warranty['notes'];
        }
    }


    public function insert() {
        $id = DB::sql()->insert("INSERT INTO mould_warranties (mould, start_date, start_strokes, guaranteed_part, guaranteed_strokes, notes, total) VALUES (?, ?, ?, ?, ?, ?, ?)", 
            [$this->mould, $this->startDate,$this->startStrokes, $this->guaranteedPart, $this->guaranteedStrokes, $this->notes, $this->isTotalWarranty]);
        $this->id = $id;
    }

    public function update() {
        DB::sql()->update("UPDATE mould_warranties SET start_date = ?, start_strokes=?, guaranteed_part = ?, guaranteed_strokes = ?, total = ? , notes = ? WHERE mould = ? AND id = ?", 
            [$this->startDate,$this->startStrokes, $this->guaranteedPart, $this->guaranteedStrokes, $this->isTotalWarranty, $this->notes, $this->mould, $this->id]);
    }

    public function delete() {
        DB::sql()->delete("DELETE FROM mould_warranties WHERE mould = ? AND id = ?", [$this->mould, $this->id]);
    }

    // Funzione di utilità per visualizzare la garanzia come array
    public function toArray() {
        return [
            'mould' => $this->mould,
            'id' => $this->id,
            'start_date' => $this->startDate,
            'start_strokes' => $this->startStrokes,
            'guaranteed_part' => $this->guaranteedPart,
            'guaranteed_strokes' => $this->guaranteedStrokes,
            'notes' => $this->notes,
            'total' => $this->isTotalWarranty
        ];
    }

    public static function createMouldWarrantyTableIfNotExists() {
 
        DB::sql()->create("
            CREATE TABLE IF NOT EXISTS mould_warranties (
                id INT AUTO_INCREMENT PRIMARY KEY,
                mould VARCHAR(255) NOT NULL,
                start_date DATE NOT NULL,
                start_strokes INT(11) NOT NULL DEFAULT '0';
                guaranteed_part TEXT NOT NULL,
                guaranteed_strokes INT NOT NULL,
                notes TEXT,
                total BOOLEAN NOT NULL DEFAULT FALSE,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            );
        ");
    }


    public static function all($mould) {
        $warranties = DB::sql()->select("SELECT * FROM mould_warranties WHERE mould = ? ORDER BY start_date", [$mould]);
        return $warranties;
    }
}
