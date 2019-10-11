//gamesにはthis.gameを入れます
//positionにはthis.positonsを入れます。
//rankにはthis.ranksを入れます。

//これはプレイゲームでゲーム選択を変えた際に
//それに対応するポジションとランクを変えるものである。

//使い例 これは使う時に他のファイルで打つコードである。
// const PR = gamePR(this.game, this.positions, this.ranks);
// this.position = PR[0].slice();
// this.rank = PR[1].slice();
export function gamePR(game, position, rank) {

    const positions = position.filter(x => game == x.game_id)

    const ranks = rank.filter(x => game == x.game_id)

    return [positions, ranks]
}

export function objectKey(object, key) {

    const array = []

    object.forEach(x => array.push(x[key]))

    return array
}
